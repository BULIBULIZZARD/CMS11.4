<?php

    class ManageAction extends Action{
  
        //构造方法
        public function __construct(&$_tpl){
            parent::__construct($_tpl, new ManageModel());
            
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
            parent::page($this->_model->getManageTotal());
            $this->_tpl->assgin('show',true);
            $this->_tpl->assgin('title','管理员列表');
            $this->_tpl->assgin('AllManage', $this->_model->getManage());
           
            
        }
        
        private function add(){
            if (isset($_POST['send'])){
                if(Validate::checkNull($_POST['admin_user']))Tool::alertBack('用户名格式错误');
                if(Validate::checkLength($_POST['admin_user'],2,true))Tool::alertBack('用户名名不能小于两位');
                if(Validate::checkLength($_POST['admin_user'],20,false))Tool::alertBack('用户名名不能大于二十位');
                if(Validate::checkNull($_POST['admin_pass']))Tool::alertBack('密码格式错误');
                if(Validate::checkLength($_POST['admin_pass'],6,true))Tool::alertBack('密码不能小于六位');
                if(Validate::checkLength($_POST['readmin_pass'],6,true))Tool::alertBack('密码不能小于六位');
                if(Validate::checkEquals($_POST['admin_pass'], $_POST['readmin_pass']))Tool::alertBack('两次密码不一致!');
                $this->_model->_admin_user=$_POST['admin_user'];
                if($this->_model->getOneManage())Tool::alertBack('用户名已存在');
                $this->_model->_admin_pass=sha1($_POST['admin_pass']);
                $this->_model->_level=$_POST['level'];
                $this->_model->addManage()?Tool::alertLocation('管理员添加成功', 'manage.php?action=show'):Tool::alertBack('添加失败请重试');
            }
            $this->_tpl->assgin('add', true);
            $_level=new LevelModel();
            $this->_tpl->assgin('AllLevel',$_level->getAllLevel());
            $this->_tpl->assgin('title','新增管理员');
            $this->_tpl->assgin('prev_url',PREV_URL);
        }
        private function update(){
            if(isset($_POST['send'])){
                if(Validate::checkNull($_POST['admin_user']))Tool::alertBack('用户名格式错误');
                if(Validate::checkLength($_POST['admin_user'],2,true))Tool::alertBack('用户名名不能小于两位');
                if(Validate::checkLength($_POST['admin_user'],20,false))Tool::alertBack('用户名名不能大于二十位');
                $_password=Validate::checkNull($_POST['admin_pass']);
                if (!$_password){
                    if(Validate::checkLength($_POST['admin_pass'],6,true))Tool::alertBack('密码名不能小于六位');
                    $this->_model->_admin_pass=sha1($_POST['admin_pass']);
                }
                $this->_model->id=$_POST['id'];
                $this->_model->_level=$_POST['level'];
                $this->_model->updateManage(!$_password)?Tool::alertLocation('信息修改成功',$_POST['prev_url']):Tool::alertBack('修改失败请重试');
            }
            if(isset($_GET['id'])){
                $this->_model->id=$_GET['id'];
                $_manage=$this->_model->getOneManage();
                is_object($_manage)?true:Tool::alertBack('无效的id');
                $this->_tpl->assgin('admin_user',$_manage->admin_user);
                $this->_tpl->assgin('id',$_manage->id);
                $this->_tpl->assgin('level',$_manage->level);
                $_level=new LevelModel();
                $this->_tpl->assgin('AllLevel',$_level->getAllLevel());
                $this->_tpl->assgin('update',true);
                $this->_tpl->assgin('title','更新管理员信息');
                $this->_tpl->assgin('prev_url',PREV_URL);
                
            }else {
                Tool::alertBack('UPDATE----非法操作');
            }
        }
        private function delete(){
            if (isset($_GET['id'])){
                $this->_model->id=$_GET['id'];
                $this->_model->deleteManage()?Tool::alertLocation('删除成功',PREV_URL):Tool::alertBack('删除失败');
            }else {
                Tool::alertBack('DELETE----非法操作');
            }
            $this->_tpl->assgin('delete',true);
            
        }
        
    }
   

?>
