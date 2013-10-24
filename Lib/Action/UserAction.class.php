<?php
//用户模块
class UserAction extends Action{

    protected function _initialize() {
        //$app_id = $this->_param('app'); //为什么不能用
        $app_id = $_REQUEST['app'];
        $App = M('App');
        if($app_id){
            $app = $App->find($app_id);
            if(!$app){
                $app = $App->find('moeid');
            }
        }else{
            $app = $App->find('moeid');
        }
        $this->assign('app',$app);
    }

    //定义一个add操作方法
    public function add(){
        //add操作方法逻辑的实现
        // ...
        $this->display();//输出页面模板
    }
    public function sign_in() {
        $this->display();
    }
    public function sign_up() {
        $this->display();
    }
    public function do_sign_up() {
        if(!session('captcha') or session('captcha') != $this->_request('captcha')){
            //验证码错误
        }else{
            session('captcha', null);
        }
    }
    public function captcha() {
        $rand = rand(0,4);
        session('captcha', $rand);
        //$this->show("test"); //又是方法不存在！！
        echo($rand); // FUCK ThinkPHP
    }
}