<?php
//用户模块
class UserAction extends Action{

    protected function _initialize() {
        $app_id = $_REQUEST['app']; //为什么不能用
        $App = D('App');
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
        $User = D('User');
        if(!session('captcha') or session('captcha') != $_REQUEST['captcha']){
            echo '验证码错误';
        }else{
            $data = array(
                'name' => $_REQUEST['name'],
                'password' => $_REQUEST['password'],
                'repassword' => $_REQUEST['repassword'],
                'email' => $_REQUEST['email']
            );
            if($User->add($data)){
                echo 'success';
            }else{
                var_dump($User->getError());
            }
        }
        session('captcha', null);
    }
    public function captcha() {
        $rand = rand(0,4);
        session('captcha', $rand);
        //$this->show("test"); //又是方法不存在！！
        echo($rand); // FUCK ThinkPHP
    }
}