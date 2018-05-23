<?php

    class RotatainAction extends Action{
        //构造方法
        public function __construct(&$_tpl){
            parent::__construct($_tpl, new RotatainModel());
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
            isset($_GET['id'])?true:Tool::alertBack('ERROR---EMPTY_COMMENT_ID');
            $this->_model->id=$_GET['id'];
            if(!$this->_model->getOneRotatain())Tool::alertBack('ERROR---WORNG_ROTATAIN_ID');
            if ($_GET['type']=='ok'){
                $this->_model->getSetRotatainTotal()==RO_NUM?Tool::alertBack('当前已有'.RO_NUM.'个图片轮播,请取消一个或多个图片轮播后再进行设置轮播'):true;
                $this->_model->setStateOk()?Tool::alertLocation(null,PREV_URL):Tool::alertBack('操作失败请重试');
            }else if($_GET['type']=='notok'){
                $this->_model->setStateNotOk()?Tool::alertLocation(null,PREV_URL):Tool::alertBack('操作失败请重试');
            }else{
                Tool::alertBack('ERROR---WRONG_TYPE');
            }
        }
        private function show(){
            parent::page($this->_model->getRotatainTotal());
            $this->_tpl->assgin('show',true);
            $this->_tpl->assgin('title','轮播器列表');
            $_object=$this->_model->getAllRotatain();
            Tool::subStr($_object,'link',30, 'utf-8');
            if($_object)
            {
                foreach ($_object as $_value){
                    $_value->state?$_value->state='<span class="green">是</span>':$_value->state='<span class="red">否</span>';
                }   
            }
            $this->_tpl->assgin('AllRotatain', $_object);
        }
        
        private function add(){
            if (isset($_POST['send'])){
                Validate::checkNull($_POST['thumbnail'])?Tool::alertBack('请上传一张图片'):true;
                Validate::checkNull($_POST['link'])?Tool::alertBack('链接不能为空'):true;
                Validate::checkNull($_POST['title'])?Tool::alertBack('标题不能为空'):true;
                !Validate::checkLength($_POST['link'],100, false)?true:Tool::alertBack('链接的长度不能超过100个字符');
                !Validate::checkLength($_POST['title'],20, false)?true:Tool::alertBack('标题的长度不能超过20个字符');
                !Validate::checkLength($_POST['info'],200, false)?true:Tool::alertBack('内容的长度不能超过200个字符');
                $this->_model->link=$_POST['link'];
                $this->_model->thumbnail=$_POST['thumbnail'];
                $this->_model->title=$_POST['title'];
                $this->_model->info=$_POST['info'];
                $this->_model->addRotatain()?Tool::alertLocation('新增成功','rotatain.php?action=show'):Tool::alertBack('新增失败请重试');
            }
            $this->_tpl->assgin('add', true);
            $this->_tpl->assgin('title','新增轮播器');
            $this->_tpl->assgin('prev_url',PREV_URL);
        }
        private function update(){
            if (isset($_POST['send'])){
                Validate::checkNull($_POST['thumbnail'])?Tool::alertBack('请上传一张图片'):true;
                Validate::checkNull($_POST['link'])?Tool::alertBack('链接不能为空'):true;
                Validate::checkNull($_POST['title'])?Tool::alertBack('标题不能为空'):true;
                !Validate::checkLength($_POST['link'],100, false)?true:Tool::alertBack('链接的长度不能超过100个字符');
                !Validate::checkLength($_POST['title'],20, false)?true:Tool::alertBack('标题的长度不能超过20个字符');
                !Validate::checkLength($_POST['info'],200, false)?true:Tool::alertBack('内容的长度不能超过200个字符');
                $this->_model->id=$_POST['id'];
                $this->_model->thumbnail=$_POST['thumbnail'];
                $this->_model->info=$_POST['info'];
                $this->_model->title=$_POST['title'];
                $this->_model->link=$_POST['link'];
                $this->_model->updateRotatain()?Tool::alertLocation('更新成功', 'rotatain.php?action=show'):Tool::alertBack('更新失败请重试');
            }
            if (!isset($_GET['id'])||empty($_GET['id']))Tool::alertBack('ERROR---ID_IS_EMPTY!!');
            $this->_model->id=$_GET['id'];
            $_rotatain=$this->_model->getRotatain();
            if(!$_rotatain)Tool::alertBack('ERROR---WRONG_ROTATAIN_ID');
            $this->_tpl->assgin('update', true);
            $this->_tpl->assgin('link', $_rotatain->link);
            $this->_tpl->assgin('thumbnail', $_rotatain->thumbnail);
            $this->_tpl->assgin('titlec', $_rotatain->title);
            $this->_tpl->assgin('info', $_rotatain->info);
            $this->_tpl->assgin('id', $_rotatain->id);
            $this->_tpl->assgin('title','更新轮播器信息');
        }
        private function delete(){
            if (isset($_GET['id'])){
                $this->_model->id=$_GET['id'];
                $this->_model->deleteRotatain()?Tool::alertLocation('删除成功',PREV_URL):Tool::alertBack('删除失败');
            }else {
                Tool::alertBack('DELETE----非法操作');
            }
        }        
    }
   

?>
