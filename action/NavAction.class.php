<?php

    class NavAction extends Action{
  
        //构造方法
        public function __construct(&$_tpl){
            parent::__construct($_tpl, new NavModel());
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
                case 'showchild':
                    $this->showchild();
                    break;
                case 'addchild':
                    $this->addchild();
                    break;
                case 'sort':
                    $this->sort();
                    break;
                default:
                    Tool::alertBack('非法操作');
                    break;
            }
        }
        public function showfront(){
            $this->_tpl->assgin('FrontNav',$this->_model->getFront());
        }
        
        private function sort(){
            if(isset($_POST['send'])){
                $_sort=$_POST['sort'];
                foreach ($_sort as $_key=>$_value){
                   if (!is_numeric($_value))continue;
                   $this->_model->_id=$_key;
                   $this->_model->_sort=$_value;
                   $this->_model->updateSort();
                }
//              
                Tool::alertLocation(null, PREV_URL);
            }else {
                Tool::alertBack('ERROR---SEND');
            }
        }
        private function addchild(){
            if (isset($_POST['send'])){
                $this->add();
            }
            if(isset($_GET['id'])){
                $this->_model->_id=$_GET['id'];
                $_nav=$this->_model->getOneNav(false);
                is_object($_nav)?true:Tool::alertBack('ERROR--WRONGID');
                $this->_tpl->assgin('id',$_GET['id']);
                $this->_tpl->assgin('addchild',true);
                $this->_tpl->assgin('prev_name',$_nav->nav_name);
                $this->_tpl->assgin('pid',$_nav->id);
                $this->_tpl->assgin('title','新增子导航');
                $this->_tpl->assgin('prev_url',PREV_URL);
            }else {
                Tool::alertBack('ERROR---ID');
            }
        }
        private function showchild(){
            if(isset($_GET['id'])){
                $this->_model->_id=$_GET['id'];
                $_nav=$this->_model->getOneNav(false);
                is_object($_nav)?true:Tool::alertBack('ERROR--WRONGID');
                $this->_tpl->assgin('prev_name',$_nav->nav_name);
                $this->_tpl->assgin('id',$_nav->id);
                $this->_tpl->assgin('showchild',true);
                $this->_tpl->assgin('title','子导航列表');
                $this->_model->_pid=$_GET['id'];
                parent::page($this->_model->getNavChildTotal());
                $this->_tpl->assgin('AllChildNav', $this->_model->getAllChildNav());
                $this->_tpl->assgin('prev_url',PREV_URL);
                
            }
        }
        private function show(){
            parent::page($this->_model->getNavTotal());
            $this->_tpl->assgin('show',true);
            $this->_tpl->assgin('title','导航列表');
            $this->_tpl->assgin('AllNav', $this->_model->getAllNav());
        }
        
        private function add(){
            
            if(isset($_POST['send'])){
                if(Validate::checkNull($_POST['nav_name']))Tool::alertBack('导航名称不能为空');
                if(Validate::checkLength($_POST['nav_name'],2, true))Tool::alertBack('导航名称不能小于两位');
                if(Validate::checkLength($_POST['nav_name'],20, false))Tool::alertBack('导航名称不能大于二十位');
                if(Validate::checkLength($_POST['nav_info'],200, false))Tool::alertBack('导航说明不能大于二百位');
                $this->_model->_nav_name=$_POST['nav_name'];
                $this->_model->_nav_info=$_POST['nav_info'];
                isset($_POST['pid'])?$this->_model->_pid=$_POST['pid']:$this->_model->_pid=0;
                if($this->_model->getOneNav(true))Tool::alertBack('此导航已存在');
                if(!isset($_POST['pid'])){
                    $_return="nav.php?action=show";
                }else {
                    $_return="nav.php?action=showchild&id=".$this->_model->_pid;
                }
                $this->_model->addNav()?Tool::alertLocation('添加导航成功', $_return):Tool::alertBack('添加失败请重试');
            }
            $this->_tpl->assgin('add',true);
            $this->_tpl->assgin('title','新增导航');
            $this->_tpl->assgin('prev_url',PREV_URL);
        }
        private function update(){
            if(isset($_POST['send'])){
                if(Validate::checkNull($_POST['nav_name']))Tool::alertBack('导航名称不能为空');
                if(Validate::checkLength($_POST['nav_name'],2, true))Tool::alertBack('导航名称不能小于两位');
                if(Validate::checkLength($_POST['nav_name'],20, false))Tool::alertBack('导航名称不能大于二十位');
                if(Validate::checkNull($_POST['nav_info']))Tool::alertBack('导航说明不能为空');
                if(Validate::checkLength($_POST['nav_info'],200, false))Tool::alertBack('导航说明不能大于二百位');
                $this->_model->_id=$_POST['id'];
                $this->_model->_nav_name=$_POST['nav_name'];
                if($this->_model->getOnenav(true)&&!$this->_model->isNav())Tool::alertBack('导航已存在');
                $this->_model->_nav_info=$_POST['nav_info'];
                
                $_return=$_POST['prev_url'];
                $this->_model->updateNav()?Tool::alertLocation('更新导航成功', $_return):Tool::alertBack('修改失败请重试');
            }
            if(isset($_GET['id'])){
                $this->_model->_id=$_GET['id'];
                $_nav=$this->_model->getOneNav(false);
                is_object($_nav)?true:Tool::alertBack('无效的导航id');
                $this->_tpl->assgin('id',$_nav->id);
                $this->_tpl->assgin('nav_name',$_nav->nav_name);
                $this->_tpl->assgin('nav_info',$_nav->nav_info);
                $this->_tpl->assgin('update', true);
                $this->_tpl->assgin('title','更新导航信息');
                $this->_tpl->assgin('prev_url',PREV_URL);
                
            }else {
                Tool::alertBack('UPDATE----非法操作');
            }
        }
        private function delete(){
            if (isset($_GET['id'])){
                $this->_model->_id=$_GET['id'];
                $this->_model->deleteNav()?Tool::alertLocation('删除成功',PREV_URL):Tool::alertBack('删除失败请调整环境重试');
            }else {
                Tool::alertBack('DELETE----非法操作');
            }
            $this->_tpl->assgin('delete',true);
            
        }
        
    }
   

?>
