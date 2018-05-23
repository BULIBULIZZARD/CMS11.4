<?php

    class FriendLinkAction extends Action{
  
        //构造方法
        public function __construct(&$_tpl){
            parent::__construct($_tpl, new LinkModel());
        }
        public function _action(){
            //业务流程控制器
            switch ($_GET['action']){
               
                case 'frontshow':
                    $this->frontshow();
                    break;
                case 'frontadd':
                    $this->frontadd();
                    break;
                default:
                    Tool::alertBack('非法操作');
                    break;
            }
        }
        //底部友情链接显示
        public function index(){
            $this->textlink();
            $this->logolink();
        }
        //
        private function textlink(){
            $this->_tpl->assgin('textlink',$this->_model->getTextLink());
        }
        private function logolink(){
            $this->_tpl->assgin('logolink',$this->_model->getLogoLink());
            
        }
        private function frontshow(){
            $this->_tpl->assgin('frontshow',true);
            $this->_tpl->assgin('alllogolink',$this->_model->getAllLogoLink());
            $this->_tpl->assgin('alltextlink',$this->_model->getAllTextLink());
        }
         
        private function frontadd(){
            if(isset($_POST['send'])){
                if(Validate::checkNull($_POST['webname']))Tool::alertBack('网站名称不能为空');
                if(Validate::checkLength($_POST['webname'],2,true))Tool::alertBack('网站名称不能小于两位');
                if(Validate::checkLength($_POST['webname'],20,false))Tool::alertBack('网站名称不能大于二十位');
                if(Validate::checkNull($_POST['weburl']))Tool::alertBack('网站链接不能为空');
                if(Validate::checkLength($_POST['weburl'],100,false))Tool::alertBack('网站链接不能大于一百位');
                if($_POST['type']==2){
                    if(Validate::checkNull($_POST['logourl']))Tool::alertBack('Logo链接不能为空');
                    $this->_model->logourl=$_POST['logourl'];
                }
                else {
                    $this->_model->logourl='';
                }
                if(Validate::checkLength($_POST['user'],20,false))Tool::alertBack('站长姓名不能大于二十位');
                Validate::checkLengthequal($_POST['code'], 4)?true:Tool::alertBack('验证码必须为四位');
                !Validate::checkEquals(strtolower($_POST['code']), $_SESSION['code'])?true:Tool::alertBack('验证码不正确');
                $this->_model->webname=$_POST['webname'];
                $this->_model->weburl=$_POST['weburl'];
                $this->_model->user=$_POST['user'];
                $this->_model->type=$_POST['type'];
                $this->_model->state=$_POST['state'];
                $this->_model->addLink()?Tool::alertClose('申请成功,请等待审核!'):Tool::alertBack('申请失败请重试');
            }
            $this->_tpl->assgin('frontadd',true);
        }
        
    }
   

?>
