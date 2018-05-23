<?php

class FeedBackAction extends Action
{

    // 构造方法
    public function __construct(&$_tpl)
    {
        parent::__construct($_tpl);
    }

    public function _action()
    {
       $this->addComment();
       $this->setCount();
       $this->showComment();
    }
    private  function  addComment(){
        if (isset($_POST['send']))   {
            $_return='http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
            if ($_return==PREV_URL){
                if(Validate::checkNull($_POST['content']))Tool::alertBack('评论内容部能为空');
                if(Validate::checkLength($_POST['content'],255,false))Tool::alertBack('评论内容不能超过255个字');
                Validate::checkLengthequal($_POST['code'], 4)?true:Tool::alertBack('验证码必须为四位');
                !Validate::checkEquals(strtolower($_POST['code']), $_SESSION['code'])?true:Tool::alertBack('验证码不正确');
            }else {
                if(Validate::checkNull($_POST['content']))Tool::alertClose('评论内容部能为空');
                if(Validate::checkLength($_POST['content'],255,false))Tool::alertClose('评论内容不能超过255个字');
                Validate::checkLengthequal($_POST['code'], 4)?true:Tool::alertClose('验证码必须为四位');
                !Validate::checkEquals(strtolower($_POST['code']), $_SESSION['code'])?true:Tool::alertClose('验证码不正确');
            }
            parent::__construct($this->_tpl,new CommentModel());
            $_cookie=new Cookie('user');
            $_cookie->getCookie()?$this->_model->user=$_cookie->getCookie():$this->_model->user='游客';
            $this->_model->manner=$_POST['manner'];
            $this->_model->content=$_POST['content'];
            $this->_model->cid=$_GET['cid'];
            $this->_model->addComment()?Tool::alertLocation('发表成功,请等待审核.', 'feedback.php?cid='.$_GET['cid']):Tool::alertBack('发表失败请重试');
            
        }
    }
    private function showComment(){
        if(!isset($_GET['cid']))Tool::alertBack('ERROR---WORNG_WAY');
        parent::__construct($this->_tpl,new CommentModel());
        $this->_model->cid=$_GET['cid'];
        parent::page($this->_model->getCommentTotal());
        $_comment=$this->_model->getAllComment();
        $_content=new ContentModel();
        $_content->id=$_GET['cid'];
        $_cont=$_content->getOneContent();
        if(!$_comment&&!$_cont){
            Tool::alertBack('ERROR---CANT_FIND_COMMENT');
        }
        foreach ($_comment as $_value){
            $_value->face?true:$_value->face='0.png';
            $_value->manner?$_value->manner='赞':$_value->manner='踩';
        }
        $this->_tpl->assgin('titlec',$_cont->title);
        $this->_tpl->assgin('info',$_cont->info);
        $this->_tpl->assgin('id',$_cont->id);
        $this->_tpl->assgin('cid',$this->_model->cid);
        $_hotComment=$this->_model->getHotComment();
        foreach ($_hotComment as $_value){
            $_value->face?true:$_value->face='0.png';
            $_value->manner?$_value->manner='赞':$_value->manner='踩';
        }
        $this->_tpl->assgin('MostComment',$_content->getMostCommentContent());
        $this->_tpl->assgin('HotComment',$_hotComment);
        $this->_tpl->assgin('AllComment',$_comment);
    }
   private function setCount(){
        if(isset($_GET['cid'])&&isset($_GET['id'])&&isset($_GET['type'])){
            parent::__construct($this->_tpl,new CommentModel());
            $this->_model->id=$_GET['id'];
            if(!$this->_model->getOneComment())Tool::alertBack('ERROR---WRONG_COMMENT_ID');
            if($_GET['type']=='sustain'){
                $this->_model->setSustain();
            }else if($_GET['type']=='oppose'){
                $this->_model->setOppose();
            }
         }
      
   }
   
}

?>
