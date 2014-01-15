<?php
//用户模块
class UserAction extends Action{
    private $app;
    protected function _initialize() {
        if(isset($_REQUEST['app'])){
            $app_id = $_REQUEST['app'];
        }elseif(isset($_SERVER['HTTP_X_MOEID_APP'])){
            $app_id = $_SERVER['HTTP_X_MOEID_APP'];
        }
        $App = D('App');
        if($app_id){
            $this->app = $App->find($app_id);
            if(!$this->app){
                $this->app = $App->find('moeid');
            }
        }else{
            $this->app = $App->find('moeid');
        }
        $this->assign('app',$this->app);
    }

    public function sign_in() {
        $this->assign('user',$_REQUEST);
        $this->display();
    }
    public function sign_up() {
        $this->assign('user',array('name'=>'', 'password'=>'','repassword'=>'','email'=>''));
        $this->assign('error',array());
        $this->display();
    }
    public function avatar(){
        $User = D('User');
        $user = $User->where(array('name'=>$_REQUEST['name']))->find();
        if($user){
            if($user['avatar']){
                $url = "https://moeid.my-card.in/avatars/$user[avatar]";
                $size = 'middle';
                if(in_array($size, array('middle','small'))){
                    $url = str_replace('/original/', "/$size/", $url);
                    $url = str_replace('.jpg', ".png", $url);
                }
                header('Location: '.$url);
            }else if($user['email']){
                $url = 'https://en.gravatar.com/avatar/'.md5(strtolower(trim($user['email']))).'?s=120';
                header('Location: '.$url);
            }else{
                header('HTTP/1.1 404 Not Found');  #fallback
            }
        }else{
            header('HTTP/1.1 404 Not Found');
        }
    }
    public function do_sign_up() {
        $User = D('User');
        if($User->
            data(array('from'=>$this->app['name']))->
            validate(array_merge($User->_validate,array('captcha',session('captcha'),'验证码不正确',Model::EXISTS_VALIDATE,'equal')))->
            create($_REQUEST) && $User->add()
        ){
            header('Location: '.$this->app['sign_up_url']);
        }else{
            $this->assign('user',$_REQUEST);
            $this->assign('error',$User->getError() ? $User->getError() : $User->getDbError());
            $this->display('sign_up');
        }
        session('captcha', null);
    }
    public function captcha() {
        $rand = (string)rand(0,4);
        session('captcha', $rand);
        //$this->show("test"); //又是方法不存在！！
        echo($rand); // FUCK ThinkPHP
    }
}