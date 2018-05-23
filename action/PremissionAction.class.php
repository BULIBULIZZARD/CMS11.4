<?php

class PremissionAction extends Action
{

    // 构造方法
    public function __construct(&$_tpl)
    {
        parent::__construct($_tpl, new PremissionModel());
    }

    public function _action()
    {
        // 业务流程控制器
        switch ($_GET['action']) {
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

    private function show()
    {
         parent::page($this->_model->getPremissionTotal());
         $this->_tpl->assgin('show',true);
         $this->_tpl->assgin('title','权限列表');
         $this->_tpl->assgin('AllPremission', $this->_model->getAllPremission());
    }

    private function add()
        {if (isset($_POST['send'])){
            if(Validate::checkNull($_POST['name']))Tool::alertBack('权限名称不能为空');
            if(Validate::checkLength($_POST['name'],2, true))Tool::alertBack('权限名称不能小于两位');
            if(Validate::checkLength($_POST['name'],20, false))Tool::alertBack('权限名称不能大于二十位');
            if(Validate::checkNull($_POST['info']))Tool::alertBack('权限说明不能为空');
            if(Validate::checkLength($_POST['info'],200, false))Tool::alertBack('权限说明不能大于二百位');
            $this->_model->name=$_POST['name'];
            if($this->_model->checkPremission())Tool::alertBack('此权限已存在');
            $this->_model->info=$_POST['info'];
            $this->_model->addPremission()?Tool::alertLocation('权限添加成功', 'premission.php?action=show'):Tool::alertBack('添加失败请重试');
        }
        $this->_tpl->assgin('add', true);
        $this->_tpl->assgin('title','新增权限');
        $this->_tpl->assgin('prev_url',PREV_URL);
    }

    private function update()
    {
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['name']))Tool::alertBack('权限名称不能为空');
            if(Validate::checkLength($_POST['name'],2, true))Tool::alertBack('权限名称不能小于两位');
            if(Validate::checkLength($_POST['name'],20, false))Tool::alertBack('权限名称不能大于二十位');
            if(Validate::checkNull($_POST['info']))Tool::alertBack('权限说明不能为空');
            if(Validate::checkLength($_POST['info'],200, false))Tool::alertBack('权限说明不能大于二百位');
            $this->_model->id=$_POST['id'];
            $this->_model->name=$_POST['name'];
            $_check=$this->_model->checkPremission();
            if($_check&&$_check->id!=$_POST['id'])Tool::alertBack('此权限已存在');
            $this->_model->info=$_POST['info'];
            $this->_model->updatePremission()?Tool::alertLocation('更新权限成功', $_POST['prev_url']):Tool::alertBack('修改失败请重试');
        }
        if(isset($_GET['id'])){
            $this->_model->id=$_GET['id'];
            $_premission=$this->_model->getOnePremission();
            is_object($_premission)?true:Tool::alertBack('ERROR---WRONG_PREMISSION_ID');
            $this->_tpl->assgin('id',$_premission->id);
            $this->_tpl->assgin('name',$_premission->name);
            $this->_tpl->assgin('info',$_premission->info);
            
            $this->_tpl->assgin('update', true);
            $this->_tpl->assgin('title','更新权限信息');
            $this->_tpl->assgin('prev_url',PREV_URL);
        }else {
            Tool::alertBack('UPDATE----非法操作');
        }
    }

    private function delete()
    {   if (isset($_GET['id'])){
            $this->_model->id=$_GET['id'];
            $this->_model->deletePremission()?Tool::alertLocation('删除成功',PREV_URL):Tool::alertBack('删除失败');
        }else {
            Tool::alertBack('DELETE----非法操作');
        }
    }
}

?>
