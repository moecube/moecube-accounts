<?php
class UserModel extends Model{
    protected $tableName = 'users';
    protected $patchValidate = true;
    protected $_validate = array(
        array('name','','帐号名称已经存在！',Model::MUST_VALIDATE,'unique'),
        array('repassword','password','确认密码不正确',Model::EXISTS_VALIDATE,'confirm'),
        array('email','email','邮箱格式不正确',Model::MUST_VALIDATE,'unique'),
        array('email','','邮箱已经存在',Model::MUST_VALIDATE,'unique'),

        array('name','require','用户名不能为空',Model::MUST_VALIDATE),
        array('password','require','密码不能为空',Model::MUST_VALIDATE),
        array('email','require','邮箱不能为空',Model::MUST_VALIDATE),
        array('captcha','require','请填写验证码',Model::MUST_VALIDATE),
    );
    protected $_auto = array (
        array('created_at','date',Model:: MODEL_INSERT,'function'),
        array('updated_at','date',Model:: MODEL_BOTH,'function'),
    );
}