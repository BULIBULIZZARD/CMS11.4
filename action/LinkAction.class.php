<?php

    class LinkAction extends Action{
  
        //构造方法
        public function __construct(&$_tpl){
            parent::__construct($_tpl, new LinkModel());
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
                case 'state':
                    $this->state();
                    break;
                default:
                    Tool::alertBack('非法操作');
                    break;
            }
        }
        private function state(){
            isset($_GET['id'])?true:Tool::alertBack('ERROR---EMPTY_LINK_ID');
            $this->_model->id=$_GET['id'];
            if(!$this->_model->checkLink())Tool::alertBack('ERROR---WORNG_LINK_ID');
            if ($_GET['type']=='ok'){
                $this->_model->setStateOk()?Tool::alertLocation(null,PREV_URL):Tool::alertBack('操作失败请重试');
            }else if($_GET['type']=='notok'){
                $this->_model->setStateNotOk()?Tool::alertLocation(null,PREV_URL):Tool::alertBack('操作失败请重试');
            }else{
                Tool::alertBack('ERROR---WRONG_TYPE');
            }
        }
        private function show(){
            parent::page($this->_model->getLinkTotal());
            $this->_tpl->assgin('show',true);
            $this->_tpl->assgin('title','友情链接列表');
            $_object=$this->_model->getAllLink();
            if($_object){
                foreach ($_object as $_value){
                    switch ($_value->type){
                        case 1:
                            $_value->ttype='文字链接';
                            break;
                        case 2:
                            $_value->ttype='图片链接 ';
                            break;
                    }
                }                
            }
            Tool::subStr($_object,'weburl',30, 'utf-8');
            Tool::subStr($_object,'logourl',30, 'utf-8');
            $this->_tpl->assgin('AllLink', $_object);
        }
        
        private function add(){
            
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
                $this->_model->webname=$_POST['webname'];
                $this->_model->weburl=$_POST['weburl'];
                $this->_model->user=$_POST['user'];
                $this->_model->type=$_POST['type'];
                $this->_model->state=$_POST['state'];
                $this->_model->addLink()?Tool::alertLocation('新增成功!','link.php?action=show'):Tool::alertBack('新增失败请重试');
            }
            $this->_tpl->assgin('add', true);
            $this->_tpl->assgin('title','新增友情链接');
            $this->_tpl->assgin('prev_url','link.php?action=show');
        }
        private function update(){
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
                $this->_model->id=$_POST['id'];
                $this->_model->webname=$_POST['webname'];
                $this->_model->weburl=$_POST['weburl'];
                $this->_model->user=$_POST['user'];
                $this->_model->type=$_POST['type'];
                $this->_model->updateLink()?Tool::alertLocation('修改成功!','link.php?action=show'):Tool::alertBack('新增失败请重试');
            }
            if(isset($_GET['id'])){
                $this->_model->id=$_GET['id'];
                $_link=$this->_model->getOneLink();
                is_object($_link)?true:Tool::alertBack('无效的等级id');
                $this->_tpl->assgin('id',$_link->id);
                $this->_tpl->assgin('webname',$_link->webname);
                $this->_tpl->assgin('weburl',$_link->weburl);
                $this->_tpl->assgin('user',$_link->user);
                $this->_tpl->assgin('type',$_link->type);
                if($_link->type=='2'){
                    $this->_tpl->assgin('type2','checked="checked"');
                    $this->_tpl->assgin('block','block');
                    $this->_tpl->assgin('logourl',$_link->weburl);
                }else{
                    $this->_tpl->assgin('type1','checked="checked"');
                    $this->_tpl->assgin('block','none');
                }
                
                $this->_tpl->assgin('update', true);
                $this->_tpl->assgin('title','修改友情链接');
                $this->_tpl->assgin('prev_url',PREV_URL);
            }else {
                Tool::alertBack('UPDATE----非法操作');
            }
        }
        private function delete(){
            if (isset($_GET['id'])){
                $this->_model->id=$_GET['id'];
                $this->_model->deleteLink()?Tool::alertLocation('删除成功',PREV_URL):Tool::alertBack('删除失败');
            }else {
                Tool::alertBack('DELETE----非法操作');
            }
            $this->_tpl->assgin('delete',true);
        }
        
    }
   

?>
