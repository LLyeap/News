<?php

namespace App\Tools;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;

class Common
{

    /**
     * 生成cookie
     *
     * @return string   cookie字符串
     */
    public static function createCookie($key)
    {
        // 检查传过来的key是否为空
        if (empty($key)) return false;

        // 对cookie进行加密
        $value = md5(COOKIE_SIGN . $key);
        return cookie($key, $value, COOKIE_LIFE_TIME);
    }

    /**
     * 验证码生成
     *
     * @param $type 验证码所属类别
     */
    public static function captcha($type)
    {
        $phrase = new PhraseBuilder;
        // 设置验证码位数
        $code = $phrase->build(4);
        // 生成验证码图片的Builder对象,配置相应属性
        $builder = new CaptchaBuilder($code, $phrase);
        // 设置背景颜色
        $builder->setBackgroundColor(220, 210, 230);
        $builder->setMaxAngle(25);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        // 可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        // 获取验证码的内容
        $phrase = $builder->getPhrase();
        // 把内容存入session
//        if($type == 10) {  // 前台找回密码
//            Session::flash('find', $phrase);
//        } else if ($type == 11) {  // 前台超过三次输出验证码
//            Session::flash('error', $phrase);
//        } else if ($type == 20) {  // 测试库登陆验证码
//            Session::flash('demoLogin', $phrase);
//        } else if ($type == 21) {  // 测试库注册验证码
//            Session::flash('demoRegister', $phrase);
//        } else {
            Session::flash('admin_code', $phrase);
//        }

        // 生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();
    }

    /**
     * 验证Cookie
     *
     * @param        $key   对应cookie的key
     * @param string $msg   拼接错误提示信息
     * @return $this|string
     */
    public static function checkCookie($key, $msg = '')
    {
        // 获取cookie
        $cookie = Cookie::get($key);

        // 进行cookie比较
        if($cookie != md5(COOKIE_SIGN . $key)) {
            $cookie = self::createCookie($key);

            // 没有传msg值,则返回一张静态图片验证码
            if (empty($msg)) {
                return self::CaptchaImg()
                    ->withCookie($cookie);
            } else {
                // 有msg值,则返回错误信息
                return response()->json(['ServerNo' => 400, 'ResultData' => $msg . '失败,请重试!'])
                    ->withCookie($cookie);
            }
        }

        // cookie验证正常返回OK
        return 'OK';
    }

    /**
     * 返回静态图片资源-验证码
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public static function CaptchaImg() {
        $fileName = mt_rand(0, 99);
        $path = public_path('common' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'yzm');
        $file = $path . DIRECTORY_SEPARATOR . $fileName . '.jpeg';
        return response(file_get_contents($file), 200);
    }

    /**
     * 生成经过变形的md5密码串
     *
     * @param $password 原型密码
     * @return mixed    经过变形的md5密码
     */
    public static function myMd5Password($password)
    {
        $str = md5($password);
        $str_before = substr($str, 0, 2);
        $str_after  = substr($str, 2);
        $str = $str_after . $str_before;

        return $str;
    }

    /**
     * 通用json格式返回
     *
     * @param $result service层查询数据库后返回的数组
     * @return array  返回给Controller进行json返回的json格式数据
     */
    public static function Res($result)
    {
        if ($result['status']) { // 如果service层返回正确
            return ['ServerNo' => 200, 'ResultData' => $result['message']];
        } else { // service层返回错误
            switch ($result['type']){ // 判断错误类型
                case 'danger':
                    return ['ServerNo' => 400, 'ResultData' => $result['message']];
                case 'err':
                    return ['ServerNo' => 500, 'ResultData' => $result['message']];
                default :
                    return ['ServerNo' => 500, 'ResultData' => '未知错误'];
            }
        }
    }
}