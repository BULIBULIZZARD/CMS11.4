<?php
    
    class LoginAction extends Action{
        //构造方法
        public function __construct(&$_tpl){
            parent::__construct($_tpl, new ManageModel());
            
        }
        public function _action(){
                switch ($_GET['action']){
                    case 'login':
                        $this->login();
                        break;
                    case 'logout':
                        $this->logout();
                        break; 
                }
        }
        
        private function logout(){
            Tool::unSession();
            Tool::alertLocation(null, 'admin_login.php');
        }
        
        
        private function login(){
            if(isset($_POST['send'])){
                Validate::checkLengthequal($_POST['code'], 4)?true:Tool::alertBack('验证码必须为四位');
                !Validate::checkEquals(strtolower($_POST['code']), $_SESSION['code'])?true:Tool::alertBack('验证码不正确');
                if(Validate::checkNull($_POST['admin_user']))Tool::alertBack('用户名格式错误');
                if(Validate::checkLength($_POST['admin_user'],2,true))Tool::alertBack('用户名不能小于两位');
                if(Validate::checkLength($_POST['admin_user'],20,false))Tool::alertBack('用户名不能大于二十位');
                if(Validate::checkNull($_POST['admin_pass']))Tool::alertBack('密码格式错误');
                if(Validate::checkLength($_POST['admin_pass'],6,true))Tool::alertBack('密码不能小于六位');
                $this->_model->_admin_user=trim($_POST['admin_user']);
                $this->_model->_admin_pass=sha1(trim($_POST['admin_pass']));
                $_login=$this->_model->getLoginManage();
                if(!$_login)Tool::alertBack('用户名或密码错误');
                if (Validate::checkPremission(2,$_login->premission))Tool::alertBack('您没有登陆后台的权限');
                    $_SESSION['admin']['admin_user']=$_login->admin_user;
                    $_SESSION['admin']['level_name']=$_login->level_name;
                    $_SESSION['admin']['premission']=$_login->premission;
                    $this->_model->_last_ip=$_SERVER["REMOTE_ADDR"];
                    $this->_model->setLoginCount();
                    Tool::alertLocation(null,'admin.php');
            }
        }
    }
?>