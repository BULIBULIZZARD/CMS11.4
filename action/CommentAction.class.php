<?php
    class CommentAction extends Action{
        //构造方法
        public function __construct(&$_tpl){
            parent::__construct($_tpl, new CommentModel());
            
        }
        public function _action(){
            //业务流程控制器
            switch ($_GET['action']){
                case 'show':
                    $this->show();
                    break;
                case 'delete':
                    $this->delete();
                    break;
                case 'state':
                    $this->state();
                    break;
                case 'check':
                    $this->check();
                    break;
                default:
                    Tool::alertBack('非法操作');
                    break;
            }
        }
        private function check(){
            if (!empty($_POST['okid'])){
                $this->_model->id= Tool::objArrOfStr($_POST['okid'], null);
                $this->_model->setStateOk()?true:Tool::alertBack('操作失败重试');
            }
            if (!empty($_POST['notokid'])){
                $this->_model->id= Tool::objArrOfStr($_POST['notokid'], null);
                $this->_model->setStateNotOk()?true:Tool::alertBack('操作失败重试');
            }
            Tool::alertLocation(null,PREV_URL);
        }
        private function state(){
            isset($_GET['id'])?true:Tool::alertBack('ERROR---EMPTY_COMMENT_ID');
            $this->_model->id=$_GET['id'];
            if(!$this->_model->getOneComment())Tool::alertBack('ERROR---WORNG_COMMENT_ID');
            if ($_GET['type']=='ok'){
                $this->_model->setStateOk()?Tool::alertLocation(null,PREV_URL):Tool::alertBack('操作失败请重试');
            }else if($_GET['type']=='notok'){
                $this->_model->setStateNotOk()?Tool::alertLocation(null,PREV_URL):Tool::alertBack('操作失败请重试');
            }else{
                Tool::alertBack('ERROR---WRONG_TYPE');
            }
        }
        private function show(){
            parent::page($this->_model->getCommentListTotal());
            $this->_tpl->assgin('show',true);
            $this->_tpl->assgin('title','评论列表');
            $_object=$this->_model->getCommentList();
            Tool::subStr($_object,'content',32,'utf-8');
            if($_object)
            {
                foreach($_object as $_value){
                    !empty($_value->state)?$_value->state='<span class="green">已审核</span>':$_value->state='<span class="red">未审核</span>';
                }
            }
            $this->_tpl->assgin('AllComment',$_object);
        }
        private function delete(){
            if (isset($_GET['id'])){
                $this->_model->id=$_GET['id'];
                $this->_model->deleteComment()?Tool::alertLocation('删除成功',PREV_URL):Tool::alertBack('删除失败');
            }else {
                Tool::alertBack('DELETE----非法操作');
            }
            $this->_tpl->assgin('delete',true);
        }
        
    }
   

?>
