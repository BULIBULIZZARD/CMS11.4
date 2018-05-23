<?php

    class LevelAction extends Action{
  
        //构造方法
        public function __construct(&$_tpl){
            parent::__construct($_tpl, new LevelModel());
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
            parent::page($this->_model->getLevelTotal());
            $this->_tpl->assgin('show',true);
            $this->_tpl->assgin('title','等级列表');
            $this->_tpl->assgin('AllLevel', $this->_model->getAllLimitLevel());
        }
        private function premission(){
            $_premission=new PremissionModel();
            $this->_tpl->assgin('AllPremission',$_premission->getPremission());
        }
        private function add(){
            if (isset($_POST['send'])){
                if(Validate::checkNull($_POST['level_name']))Tool::alertBack('职务名称不能为空');
                if(Validate::checkLength($_POST['level_name'],2, true))Tool::alertBack('职务名称不能小于两位');
                if(Validate::checkLength($_POST['level_name'],20, false))Tool::alertBack('职务名称不能大于二十位');
                if(Validate::checkNull($_POST['level_info']))Tool::alertBack('职务说明不能为空');
                if(Validate::checkLength($_POST['level_info'],200, false))Tool::alertBack('职务说明不能大于二百位');
                $this->_model->_level_name=$_POST['level_name'];
                if($this->_model->getOneLevel(true))Tool::alertBack('此等级已存在');
                $this->_model->_level_info=$_POST['level_info'];
                $this->_model->premission=implode(',', $_POST['premission']);
                $this->_model->addLevel()?Tool::alertLocation('等级添加成功', 'level.php?action=show'):Tool::alertBack('添加失败请重试');
            }
            $this->_tpl->assgin('add', true);
            $this->_tpl->assgin('title','新增等级');
            $this->_tpl->assgin('prev_url',PREV_URL);
            $this->premission();
        }
        private function update(){
            if(isset($_POST['send'])){
                if(Validate::checkNull($_POST['level_name']))Tool::alertBack('职务名称不能为空');
                if(Validate::checkLength($_POST['level_name'],2, true))Tool::alertBack('职务名称不能小于两位');
                if(Validate::checkLength($_POST['level_name'],20, false))Tool::alertBack('职务名称不能大于二十位');
                if(Validate::checkNull($_POST['level_info']))Tool::alertBack('职务说明不能为空');
                if(Validate::checkLength($_POST['level_info'],200, false))Tool::alertBack('职务说明不能大于二百位');
                $this->_model->id=$_POST['id'];
                $this->_model->_level_name=$_POST['level_name'];
                if($this->_model->getOneLevel(true)&&!$this->_model->isLevel())Tool::alertBack('此等级已存在');
                $this->_model->_level_info=$_POST['level_info'];
                $this->_model->premission=implode(',', $_POST['premission']);
                $this->_model->updateLevel()?Tool::alertLocation('更新等级成功', $_POST['prev_url']):Tool::alertBack('修改失败请重试');
            }
            if(isset($_GET['id'])){
                $this->_model->id=$_GET['id'];
                $_level=$this->_model->getOneLevel(false);
                is_object($_level)?true:Tool::alertBack('无效的等级id');
                $this->_tpl->assgin('id',$_level->id);
                $this->_tpl->assgin('level_name',$_level->level_name);
                $this->_tpl->assgin('level_info',$_level->level_info);
                $this->_tpl->assgin('update', true);
                $this->_tpl->assgin('title','更新等级信息');
                $this->_tpl->assgin('prev_url',PREV_URL);
                
                if($_level){
                    $_array=explode(',',$_level->premission);
                }
                $_premission=new PremissionModel();
                $_object=$_premission->getPremission();
                foreach ($_object as $_value){
                    in_array($_value->id,$_array)?$_check='checked="checked"':$_check=null;
                    $_pm.=" <input type=\"checkbox\" name=\"premission[]\" value=\"{$_value->id}\" $_check style=\"display: inline-block;\"> ".$_value->name;
                }
                
                $this->_tpl->assgin('AllPremission',$_pm);
            }else {
                Tool::alertBack('UPDATE----非法操作');
            }
        }
        private function delete(){
            if (isset($_GET['id'])){
                $this->_model->id=$_GET['id'];
                $_manage=new ManageModel();
                $_manage->_level=$_GET['id'];
                if($_manage->getOneManage())Tool::alertBack('有用户是此等级_删除失败');
                $this->_model->deleteLevel()?Tool::alertLocation('删除成功',PREV_URL):Tool::alertBack('删除失败');
            }else {
                Tool::alertBack('DELETE----非法操作');
            }
            $this->_tpl->assgin('delete',true);
        }
        
    }
   

?>
