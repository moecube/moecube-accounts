<?php
class UserModel extends Model{
    protected $tableName = 'users';
    protected $_validate = array(
        array('name','','帐号名称已经存在！',Model::MUST_VALIDATE,'unique'),
        array('email','email','邮箱格式不正确',Model::MUST_VALIDATE,'unique'),
        array('email','','邮箱已经存在',Model::MUST_VALIDATE,'unique'),
        array('repassword','password','确认密码不正确',Model::EXISTS_VALIDATE,'confirm'),
        array('captcha','require','验证码必须！'),
    );
}