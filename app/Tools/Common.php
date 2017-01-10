<?php

namespace App\Tools;

use Illuminate\Support\Facades\Session;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;

class Common
{
    /**
     * 验证码生成
     */
    public static function captcha($temp)
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
//        if($temp == 10) {  // 前台找回密码
//            Session::flash('find', $phrase);
//        } else if ($temp == 11) {  // 前台超过三次输出验证码
//            Session::flash('error', $phrase);
//        } else if ($temp == 20) {  // 测试库登陆验证码
//            Session::flash('demoLogin', $phrase);
//        } else if ($temp == 21) {  // 测试库注册验证码
//            Session::flash('demoRegister', $phrase);
//        } else {
            Session::flash('code', $phrase);
//        }
        // 生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();
    }

}