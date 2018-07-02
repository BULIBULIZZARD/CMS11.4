<?php

    class UserAction extends Action{
        //构造方法
        public function __construct(&$_tpl){
            parent::__construct($_tpl, new UserModel());
        }
        public function _action(){
            //业务流程控制器
            switch ($_GET['action']){
                case 'show':
                    $this->show();
                    break;
                case 'add':
                    $this->add();
                    break;
                case 'update':
                    $this->update();
                    break;
                case 'delete':
                    $this->delete();
                    break;
                default:
                    Tool::alertBack('非法操作');
                    break;
            }
        }
        
        private function show(){
            parent::page($this->_model->getUserTotal());
            $this->_tpl->assgin('show',true);
            $this->_tpl->assgin('title','会员列表');
            $_object=$this->_model->getAllUser();
            foreach ($_object as $_value){
                switch ($_value->state){
                    case 0:
                        $_value->state='禁止登陆';
                        break;
                    case 1:
                        $_value->state='待审核的会员';
                        break;
                    case 2:
                        $_value->state='初级会员';
                        break;
                    case 3:
                        $_value->state='中级会员';
                        break;
                    case 4:
                        $_value->state='高级会员';
                        break;
                    case 5:
                        $_value->state='VIP会员';
                        break;
                }
            }
            $this->_tpl->assgin('AllUser',$_object);
            
        }
        
        private function add(){ 
            if (isset($_POST['send'])){
                if(Validate::checkNull($_POST['user']))Tool::alertBack('用户名格式错误');
                if(Validate::checkLength($_POST['user'],2,true))Tool::alertBack('用户名不能小于两位');
                if(Validate::checkLength($_POST['user'],20,false))Tool::alertBack('用户名不能大于二十位');
                if(Validate::checkLength($_POST['pass'],6,true))Tool::alertBack('密码不能小于六位');
                if(Validate::checkLength($_POST['pass'],20,false))Tool::alertBack('密码 不能大于二十位');
                if(Validate::checkEquals($_POST['pass'],$_POST['repass']))Tool::alertBack('两次密码不一致');
                if(Validate::checkNull($_POST['email']))Tool::alertBack('邮箱不能为空');
                if(Validate::checkEmail($_POST['email']))Tool::alertBack('邮箱格式不正确');
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
                $this->_model->state=$_POST['state'];
                $this->_model->addUser()?Tool::alertLocation('注册成功','user.php?action=show'):Tool::alertBack('注册失败请重试');
            }
            $this->_tpl->assgin('add', true);
            $this->_tpl->assgin('title','新增会员');
            $this->_tpl->assgin('OptionFace',range(1,24));
            $this->_tpl->assgin('prev_url',PREV_URL);
        }
        private function update(){
            if(isset($_POST['send'])){
                if(Validate::checkNull($_POST['email']))Tool::alertBack('邮箱不能为空');
                if(Validate::checkEmail($_POST['email']))Tool::alertBack('邮箱格式不正确');
                if(Validate::checkNull($_POST['pass'])){
                    $this->_model->pass=$_POST['ppass'];
                }else if(Validate::checkLength($_POST['pass'],6,true)){
                    Tool::alertBack('密码不能小于六位');
                }else if(Validate::checkLength($_POST['pass'],20,false)){
                    Tool::alertBack('密码 不能大于二十位');
                }else {
                    $this->_model->pass= sha1(sha1($_POST['pass']).'cmsuser');
                }
                if(Validate::checkNull($_POST['question'])){
                    $this->_model->question= '';
                    $this->_model->answer= '';
                }else{
                    $this->_model->question= $_POST['question'];
                    if (Validate::checkNull($_POST['answer']))Tool::alertBack('验证问题不能为空');
                    $this->_model->answer= $_POST['answer'];
                }
                $this->_model->email=$_POST['email'];
                if(Validate::checkEquals($_POST['email'],$_POST['eemail'])){
                    if($this->_model->checkEmail())Tool::alertBack('该邮箱已被注册');
                }
                $this->_model->id=$_POST['id'];
                $this->_model->face=$_POST['face'];
                $this->_model->state=$_POST['state'];
                $this->_model->updateUser()?Tool::alertLocation('更新成功',$_POST['prev_url']):Tool::alertBack('更新失败请重试');
            } 
            if(isset($_GET['id'])){
                $this->_model->id=$_GET['id'];
                $_user=$this->_model->getOneUser();
                if(!$_user)Tool::alertBack('ERROR---CANT_FIND_USER');
                $this->_tpl->assgin('user', $_user->user);
                $this->_tpl->assgin('email', $_user->email);
                $this->_tpl->assgin('pass', $_user->pass);
                $this->_tpl->assgin('id', $_GET['id']);
                $this->_tpl->assgin('answer', $_user->answer);
                $this->_tpl->assgin('facesrc', $_user->face);
                $this->_tpl->assgin('face',$this->face($_user->face));
                $this->_tpl->assgin('question',$this->question($_user->question));
                $this->_tpl->assgin('state',$this->state($_user->state));
                $this->_tpl->assgin('update', true);
                $this->_tpl->assgin('title','更新会员信息');
                $this->_tpl->assgin('prev_url',PREV_URL);
            }else {
                Tool::alertBack('UPDATE----非法操作');
            }
        }
        private function delete(){
            if (isset($_GET['id'])){
                $this->_model->id=$_GET['id'];
                $this->_model->deleteUser()?Tool::alertLocation('删除成功',PREV_URL):Tool::alertBack('删除失败');
            }else {
                Tool::alertBack('DELETE----非法操作');
            }
            $this->_tpl->assgin('delete',true);
            
        }
        private function state($_state){
            $_array=array(0=>'禁止登陆',1=>'待审核会员',2=>'初级会员',3=>'中级会员',4=>'高级会员',5=>'VIP会员');
            foreach ($_array as $_key=>$_value){
                $_key==$_state?$_checked='checked="checked"':$_checked=null;
                $_html.='<input type="radio" name="state" value="'.$_key.'" '.$_checked.' >'.$_value.'';
            }
            return $_html;
        }
        private function question($_question){
             $_array=array('您父亲的姓名?','您母亲的职业?','您的故乡在哪?');
             foreach ($_array as $_value){
                 $_value==$_question?$_selected='selected="selected"':$_selected=null;
                 $_html.='<option '.$_selected.' value="'.$_value.'" >'.$_value.'</option>';
             }
             return $_html;
        }
        private function face($_face){
            $_array=range(1,24);
            foreach ($_array as $_value){
                $_value.'.png'==$_face?$_selected='selected="selected"':$_selected=null;
                $_html.='<option '.$_selected.' value="'.$_value.'.png" >'.$_value.'.png</option>';
            }
            return $_html;
        }
    }
   

?>
