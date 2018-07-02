<?php

class DetailsAction extends Action
{

    // 构造方法
    public function __construct(&$_tpl)
    {
        parent::__construct($_tpl);
    }

    public function _action()
    {
        $this->getDetails();
        
    }

    // 获取文档详细内容
    private function getDetails()
    { 
        if (! isset($_GET['id']))
            Tool::alertBack('ERROR---错误的打开方式(id)');
            parent::__construct($this->_tpl, new ContentModel());
            $this->_model->id = $_GET['id'];
            $this->_model->setContentCount()?true:Tool::alertBack('不存在此文章');
            $_content = $this->_model->getOneContent();
            $this->_tpl->assgin('id',$_content->id);
            $this->_tpl->assgin('titlec', $_content->title);
            $this->_tpl->assgin('date', $_content->date);
            $this->_tpl->assgin('source', $_content->source);
            $this->_tpl->assgin('author', $_content->author);
            $this->_tpl->assgin('info', $_content->info);
            $_tarArr=explode(',', $_content->tag);
            if(is_array($_tarArr)){
                foreach ($_tarArr as $_value){
                    $_tag.=' [<a href="search.php?type=3&key='.$_value.'" target="_blank" style="color:#f60;text-decoration:none;">'.$_value.'</a>] ';
                }
            }
            $this->_tpl->assgin('tag',$_tag );
            $this->_tpl->assgin('keyword', $_content->keyword);
            $this->_tpl->assgin('content', Tool::unHtml($_content->content));
            $this->getNav($_content->nav);
            if(IS_CACHE){
                $this->_tpl->assgin('sp', '<script type="text/javascript" src="config/static.php?id='.$_content->id.'&type=details"></script>');
                $this->_tpl->assgin('count', '<script type="text/javascript" >getContentCount();</script>');
            }else {
                $this->_tpl->assgin('count', $_content->count);
            }
                $_comment=new CommentModel();
                $_comment->cid=$this->_model->id;
                $_comm=$_comment->getNewThreeComment();
                foreach ($_comm as $_value){
                    $_value->face?true:$_value->face='0.png';
                    $_value->manner?$_value->manner='赞':$_value->manner='踩';
                }
                $this->_tpl->assgin('comment', $_comment->getCommentTotal());
                $this->_tpl->assgin('newcomment',$_comm);
                $this->_model->nav=$_content->nav;
                //推荐
                $_object=$this->_model->getMonthNavRec();
                $this->setObject($_object);
                $this->_tpl->assgin('MonthNavRec',$_object);
                //热点
                $_object=$this->_model->getMonthNavHot();
                $this->setObject($_object);
                $this->_tpl->assgin('MonthNavHot',$_object);
                //图文
                $_object=$this->_model->getMonthNavPic();
                $this->setObject($_object);
                $this->_tpl->assgin('MonthNavPic',$_object);
    }

    private function getNav($_id)
    {
        $_nav = new NavModel();
        $_nav->_id = $_id;
        $_getNav = $_nav->getOneNav(false);
        if (! $_getNav)
            Tool::alertBack('ERROR---WRONG_NAV_ID');
        $_navMain = '<a href="list.php?id=' . $_getNav->id . '">' . $_getNav->nav_name . '</a>';
        $this->_tpl->assgin('nav', $_navMain);
        // 子导航
        if ($_getNav->pid == 0) {
            $_nav->_pid = $_getNav->id;
            $_childNav = $_nav->getAllChildFrontNav();
            if ($_childNav) {
                $this->_tpl->assgin('childNav', $_childNav);
            }
        } else {
            $_nav->_id = $_getNav->pid;
            $_getFather = $_nav->getOneNav(false);
            $_fathernav = '><a href="list.php?id=' . $_getFather->id . '">' . $_getFather->nav_name . '</a>';
            $this->_tpl->assgin('father', $_fathernav);
        }
    }
    
    private function setObject(&$_object){
        if ($_object){
            Tool::objDate($_object,'date');
        }
    }
}

?>
