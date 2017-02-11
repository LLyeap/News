/*
// 简单理解js封装成类如下：
// 封装：将字段，属性，方法等封装成类
// 例如：将人封装成一个类，有name,age等字段，有eat方法
function Person(name, age) {
    this._name = name;
    this._age = age;

    this.getAge = function(){
        return this.age;
    };
    this.setAge = function(value){
        this.age = value;
    };
    this.getName = function(){
        return this.name;
    };
    this.eat=function()
    {
        alert(this._name+" Eat!");
    };
}

// 使用这个类：
var p1 = new Person("李雷", 23);
p1.eat();
*/
function MyAjax() {
    this._url = '';
    this._type = '';
    this._beforeSend = function () {};
    this._success = function () {};
    this._error = function () {};


    this.setUrl = function (url) {
        this.url = url;
    };
    this.getUrl = function () {
        return this.url;
    };

    this.setType = function (type) {
        this.type = type;
    };
    this.getType = function () {
        return this.type;
    };

    this.setBeforeSend = function (beforeSend) {
        this.beforeSend = beforeSend;
    };
    this.getBeforeSend = function () {
        return this.beforeSend;
    };

    this.setSuccess = function (success) {
        this.success = success;
    };
    this.getSuccess = function () {
        return this.success;
    };

    this.setError = function (error) {
        this.error = error;
    };
    this.getError = function () {
        return this.error;
    };

    this.excuteAjax = function () {
        $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url : this.url,
            type : this.type,
            beforeSend : this.beforeSend,
            success : this.success,
            error : this.error
        });
    };
}