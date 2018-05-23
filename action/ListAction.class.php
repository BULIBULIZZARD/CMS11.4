<?php

class ListAction extends Action
{

    // 构造方法
    public function __construct(&$_tpl)
    {
        parent::__construct($_tpl);
        
    }
    
    public function _action(){
        $this->getNav();
        $this->getListContent();
    }
    
    //获取前台列表显示 
    public function getListContent(){
        
        if(isset($_GET['id'])){
            parent::__construct($this->_tpl,new ContentModel());
            $_nav=new NavModel();
            $_nav->_id=$_GET['id'];
            $_getchild= $_nav->getNavChildId();
            if($_getchild){
                $this->_model->nav=Tool::objArrOfStr($_getchild,'id');
            }else {
                $this->_model->nav=$_nav->_id;
            }
            parent::page($this->_model->getListContentTotal(),ARTICLE_SIZE);
            $_object=$this->_model->getListContent();
            Tool::subStr($_object,'info',130, 'utf-8');
            $_object=Tool::none($_object, 'thumbnail');
            $this->_tpl->assgin('AllListContent',$_object);
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
        }else {
            Tool::alertBack('ERROR---错误的打开方式');
        }
    }
    // 获取前台显示导航
    private function getNav()
    {
        if (isset($_GET['id'])) {
            $_nav = new NavModel();
            $_nav->_id = $_GET['id'];
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
                $_nav->_id=$_getNav->pid;
                $_getFather=$_nav->getOneNav(false);
                $_fathernav='><a href="list.php?id='.$_getFather->id.'">'.$_getFather->nav_name.'</a>';
                $this->_tpl->assgin('father',$_fathernav);
            }
        } else {
            Tool::alertBack('ERROR---非法操作');
        }
    }
    private function setObject(&$_object){
        if ($_object){
            Tool::objDate($_object,'date');
        }
    }
}

?>
