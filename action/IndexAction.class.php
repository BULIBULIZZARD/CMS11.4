<?php

class IndexAction extends Action
{

    // 构造方法
    public function __construct(&$_tpl)
    {
        parent::__construct($_tpl);
    }

    public function _action()
    {
        $this->login();
        $this->laterUser();
        $this->showList();
        $this->getVote();
    }
    // 获取投票
    private function getVote(){
        $_vote=new VoteModel();
        $_title=$_vote->getShowVoteTitle();
        $this->_tpl->assgin('votetitle',$_title->title);
        $this->_tpl->assgin('voteChild',$_vote->getShowChild());
    }
    //
    private function laterUser(){
        $_user=new UserModel();
        $this->_tpl->assgin('AllLaterUser',$_user->getLaterUser()) ;
    }
    //获取本月热点7tia
    //显示推荐  本月热点  头条
    private function showList(){
        parent::__construct($this->_tpl,new ContentModel());
        $_object=$this->_model->getNewRecList();
        Tool::objDate($_object, 'date');
        $this->_tpl->assgin('NewRecList',$_object);
        //当月点击top7
        $_object=$this->_model->getMonthHot();
        Tool::objDate($_object, 'date');
        $this->_tpl->assgin('MonthHot',$_object);
        //当月评论top7
        $_object=$this->_model->getMonthCommentList();
        Tool::objDate($_object, 'date');
        $this->_tpl->assgin('MonthCommentList',$_object);
        //4图文
        $_object=$this->_model->getPicList();
        Tool::subStr($_object,'title',35,'utf-8');
        $this->_tpl->assgin('PicList',$_object);
        
        //显示最新十条
        $_object=$this->_model->getNewList();
        Tool::objDate($_object2, 'date');
        $this->_tpl->assgin('NewList',$_object);
        //导入头条
        $_object=$this->_model->getNewTop();
        $this->_tpl->assgin('NewTopTitle',$_object->title);
        if(!empty($_object->info)){
            $this->_tpl->assgin('NewTopInfo',Tool::subStr($_object->info,null,88,'utf-8'));
        }
        $this->_tpl->assgin('NewTopId',$_object->id); 
        //四个头条
        $_object=$this->_model->getNewTopList();
        Tool::objDate($_object2, 'date');
        Tool::subStr($_object,'title',15,'utf-8');
        if ($_object){
            $i=1;
            foreach ($_object as $_value){
                if($i%2==0){
                    $_value->line='<br>';
                }else {
                    $_value->line='|';
                }
                $i++;
            }
        }
        $this->_tpl->assgin('NewTopList',$_object);
        //4个导航
        $_nav=new NavModel();
        $_object=$_nav->getFourNav();
        if($_object){
            $i=1;
            foreach ($_object as $_value){
                if($i%2==0){
                    $_value->class='list right bottom';
                }else {
                    $_value->class='list bottom';
                }
                $this->_model->nav=$_value->id;
                $_navList=$this->_model->getNewNavList();
                Tool::objDate($_navList, 'date');
                $_value->list=$_navList;
                $i++;
            }
        }
        $this->_tpl->assgin('FourNav',$_object);
        $this->getRotatain();
    }
    private function getRotatain(){
        $_rotatain=new RotatainModel();
        $_object=$_rotatain->getFiveRotatain();
        foreach ($_object as $_key=>$_value){
            $_key+1==1?$_value->li='<li class="active">'.($_key+1).'</li>':$_value->li='<li>'.($_key+1).'</li>';
        }
        $this->_tpl->assgin('Rotatain',$_object);
    }
    private function login(){
        $_cookie=new Cookie('user');
        $_user=$_cookie->getCookie();
        $_facecookie=new Cookie('face');
        $_face=$_facecookie->getCookie();
        if($_user&&$_face){
            $this->_tpl->assgin('user',Tool::subStr($_user, null, 8, 'utf-8'));
            $this->_tpl->assgin('face',$_face);
        }else{
            $this->_tpl->assgin('login',true);
        }
        $this->_tpl->assgin('cache',IS_CACHE);
        if(IS_CACHE)$this->_tpl->assgin('member','<script type="text/javascript">getIndexLogin();</script>');
    }
}

?>
