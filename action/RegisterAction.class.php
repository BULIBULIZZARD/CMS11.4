<?php

class RegisterAction extends Action
{

    // 构造方法
    public function __construct(&$_tpl)
    {
        parent::__construct($_tpl);
    }

    public function _action()
    {
        switch ($_GET['action']){
            case 'reg':
                $this->reg();
                break;
            case 'login':
                $this->login();
                break;
            case 'logout':
                $this->logout();
                break;
            default:
                Tool::alertBack('ERROR---WRONG_ACTION');
        }
    }
    
    private function reg(){
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['user']))Tool::alertBack('用户名格式错误');
            if(Validate::checkLength($_POST['user'],2,true))Tool::alertBack('用户名不能小于两位');
            if(Validate::checkLength($_POST['user'],20,false))Tool::alertBack('用户名不能大于二十位');
            if(Validate::checkLength($_POST['pass'],6,true))Tool::alertBack('密码不能小于六位');
            if(Validate::checkLength($_POST['pass'],20,false))Tool::alertBack('密码 不能大于二十位');
            if(Validate::checkEquals($_POST['pass'],$_POST['repass']))Tool::alertBack('两次密码不一致');
            if(Validate::checkNull($_POST['email']))Tool::alertBack('邮箱不能为空');
            if(Validate::checkEmail($_POST['email']))Tool::alertBack('邮箱格式不正确');
            Validate::checkLengthequal($_POST['code'], 4)?true:Tool::alertBack('验证码必须为四位');
            !Validate::checkEquals(strtolower($_POST['code']), $_SESSION['code'])?true:Tool::alertBack('验证码不正确');
            parent::__construct($this->_tpl,new UserModel());
            if(Validate::checkNull($_POST['question'])){
                $this->_model->question= '';
                $this->_model->answer= '';
            }else{
                $this->_model->question= $_POST['question'];
                if (Validate::checkNull($_POST['answer']))Tool::alertBack('验证问题不能为空');
                $this->_model->answer= $_POST['answer'];
            }
            $this->_model->user= $_POST['user'];
            $this->_model->checkUser()?Tool::alertBack('用户名已存在'):ture;
            $this->_model->pass= sha1(sha1($_POST['pass']).'cmsuser');
            $this->_model->email= $_POST['email'];
            $this->_model->checkEmail()?Tool::alertBack('邮箱已注册'):ture;
            $this->_model->face=$_POST['face'];
            $this->_model->state=1;
            $this->_model->addUser()?Tool::alertLocation('注册成功','?action=login'):Tool::alertBack('注册失败请重试');
        }
        $this->_tpl->assgin('reg',true);
        $this->_tpl->assgin('OptionFace',range(1,24));
    }
    private function login(){
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['user']))Tool::alertBack('用户名格式错误');
            if(Validate::checkLength($_POST['user'],2,true))Tool::alertBack('用户名不能小于两位');
            if(Validate::checkLength($_POST['user'],20,false))Tool::alertBack('用户名不能大于二十位');
            if(Validate::checkLength($_POST['pass'],6,true))Tool::alertBack('密码不能小于六位');
            if(Validate::checkLength($_POST['pass'],20,false))Tool::alertBack('密码 不能大于二十位');
            Validate::checkLengthequal($_POST['code'], 4)?true:Tool::alertBack('验证码必须为四位');
            !Validate::checkEquals(strtolower($_POST['code']), $_SESSION['code'])?true:Tool::alertBack('验证码不正确');
            parent::__construct($this->_tpl,new UserModel());
            $this->_model->user=$_POST['user'];
            $this->_model->pass=sha1(sha1($_POST['pass']).'cmsuser');
            $_user=$this->_model->checkLogin();
            if($_user){
                $cookie=new Cookie('user',$_user->user,$_POST['time']);
                $cookie->setCookie();
                $facecookie=new Cookie('face',$_user->face,$_POST['time']);
                $facecookie->setCookie();
                $this->_model->time=time();
                $this->_model->setLater();
                Tool::alertLocation(null,'./');
            }else{
                Tool::alertBack('用户名或密码错误');
            }
        }
        $this->_tpl->assgin('login',true);
    }

    private function logout(){
        $_cookie=new Cookie('user');
        $_cookie->unCookie();
        Tool::alertLocation(null, './');
    }
}

?>
