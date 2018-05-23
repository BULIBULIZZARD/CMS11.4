<?php

    class VoteAction extends Action{
  
        //构造方法
        public function __construct(&$_tpl){
            parent::__construct($_tpl, new VoteModel());
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
                case 'addchild':
                    $this->addchild();
                    break;
                case 'showchild':
                    $this->showchild();
                    break;
                case 'state':
                    $this->state();
                    break;
                default:
                    Tool::alertBack('非法操作');
                    break;
            }
        }
        
        private function show(){
            parent::page($this->_model->getVoteTotal());
            $this->_tpl->assgin('show',true);
            $this->_tpl->assgin('title','投票主题列表');
            $_object=$this->_model->getAllVote();
            if($_object){
                foreach ($_object as $_value){
                    if(!$_value->pcount)$_value->pcount=0;
                }
            }
            $this->_tpl->assgin('AllVote', $_object);
        }
        private function showchild(){
            if (!isset($_GET['id'])||empty($_GET['id']))Tool::alertBack('ERROR_EMPTY_VOTE_ID');
            $this->_model->vid=$_GET['id'];
            $this->_model->id=$_GET['id'];
            $_vote=$this->_model->getOneTitle();
            $this->_tpl->assgin('id', $_vote->id);
            $this->_tpl->assgin('titlec',$_vote->title);
            $_vote?true:Tool::alertBack('ERROR---WRONG_VOTE_ID');
            parent::page($this->_model->getVoteChildTotal());
            $this->_tpl->assgin('showchild',true);
            $this->_tpl->assgin('prev_url',PREV_URL);
            $this->_tpl->assgin('title','投票项目列表');
            $_object=$this->_model->getAllChildVote();
            $this->_tpl->assgin('AllChildeVote',$_object);
        }
        private function add(){
            if(isset($_POST['send'])){
                $this->setAdd();
                $this->_model->addVote()?Tool::alertLocation("新增成功",'vote.php?action=show'):Tool::alertBack('新增失败请重试');
            }
            $this->_tpl->assgin('add', true);
            $this->_tpl->assgin('title','新增投票主题');
            $this->_tpl->assgin('prev_url',PREV_URL);
        }
        private function addchild(){
            if(isset($_POST['send'])){
                $this->setAdd();
                $this->_model->vid=$_POST['id'];
                $this->_model->addVote()?Tool::alertLocation("新增成功",'?action=showchild&id='.$_POST['id']):Tool::alertBack('新增失败请重试');
            }
            if (!isset($_GET['id'])||empty($_GET['id']))Tool::alertBack('ERROR_EMPTY_VOTE_ID');
            $this->_model->id=$_GET['id'];
            $_vote=$this->_model->getOneTitle();
            $_vote?true:Tool::alertBack('ERROR---WRONG_VOTE_ID');
            $this->_tpl->assgin('id', $_vote->id);
            $this->_tpl->assgin('titlec',$_vote->title);
            $this->_tpl->assgin('addchild', true);
            $this->_tpl->assgin('title','新增投票项目');
            $this->_tpl->assgin('prev_url',PREV_URL);
        }
        
        private function setAdd(){
            if(Validate::checkNull($_POST['title']))Tool::alertBack('标题不能为空');
            if(Validate::checkLength($_POST['title'],2, true))Tool::alertBack('标题不能小于两位');
            if(Validate::checkLength($_POST['title'],20, false))Tool::alertBack('标题不能大于二十位');
            if(Validate::checkLength($_POST['info'],200, false))Tool::alertBack('说明不能大于二百位');
            $this->_model->title=$_POST['title'];
            $this->_model->info=$_POST['info'];
        }
        private function update(){
            if(isset($_POST['send'])){
                $this->setAdd();
                $this->_model->id=$_POST['id'];
                $this->_model->updateVote()?Tool::alertLocation("更新成功",'?action=update&id='.$_POST['id']):Tool::alertBack('更新失败请重试');
            }
            if(!isset($_GET['id']))Tool::alertBack("ERROR---EMPTY_VOTE_ID");
                $this->_model->id=$_GET['id'];
                $_vote=$this->_model->getOneTitle();
                $_vote?true:Tool::alertBack('ERROR---WRONG_VOTE_ID');
                $this->_tpl->assgin('id',$_vote->id);
                $this->_tpl->assgin('titlec',$_vote->title);
                $this->_tpl->assgin('info',$_vote->info);
                if($_vote->vid){
                    $this->_tpl->assgin('name','项目');
                }else {
                    $this->_tpl->assgin('name','主题');
                }
                $this->_tpl->assgin('update', true);
                $this->_tpl->assgin('title','修改投票主题');
                $this->_tpl->assgin('prev_url',PREV_URL);
            
        }
        private function state(){
            isset($_GET['id'])?true:Tool::alertBack('ERROR---EMPTY_COMMENT_ID');
            $this->_model->id=$_GET['id'];
            if(!$this->_model->getOneTitle())Tool::alertBack('ERROR---WORNG_ROTATAIN_ID');
            $this->_model->setStateNotOk()?true:Tool::alertBack('操作失败请重试');
            $this->_model->setState()?Tool::alertLocation(null, PREV_URL):Tool::alertBack('设置失败请重试');
                      
        }
        private function delete(){
            if (isset($_GET['id'])){
                $this->_model->id=$_GET['id'];
                $this->_model->deleteVote()?Tool::alertLocation('删除成功',PREV_URL):Tool::alertBack('删除失败');
            }else {
                Tool::alertBack('DELETE----非法操作');
            }
        }
        
    }
   

?>
