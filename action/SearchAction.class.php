<?php

class SearchAction extends Action
{

    // 构造方法
    public function __construct(&$_tpl)
    {
        parent::__construct($_tpl,new ContentModel());
        
    }
    
    public function _action(){
        $this->searchKeyword();
        $this->searchTitle();
        $this->searchTag();
        $this->sideBar();
        $this->getSearch();
    }
    
    private function searchTitle(){
        if($_GET['type']==1){
            if(empty($_GET['key']))Tool::alertBack('请输入申请关键字');
            $this->_model->search=$_GET['key'];
            parent::page($this->_model->searchTitleTotal());
            $_object=$this->_model->searchTitleContent();
            Tool::subStr($_object,'info',130, 'utf-8');
            if($_object){
                foreach ($_object as $_value){
                    $_value->title=str_replace($_GET['key'], '<span class="red">'.$_GET['key'].'</span>', $_value->title);
                }
            }
            $_object=Tool::none($_object, 'thumbnail');
            $this->_tpl->assgin('SearchContent',$_object);
        }
    }
    
    private function searchKeyword(){
        if($_GET['type']==2){
            if(empty($_GET['key']))Tool::alertBack('请输入申请关键字');
            $this->_model->search=$_GET['key'];
            parent::page($this->_model->searchKeywordTotal());
            $_object=$this->_model->searchKeywordContent();
            Tool::subStr($_object,'info',130, 'utf-8');
            if($_object){
                foreach ($_object as $_value){
                    $_value->keyword=str_replace($_GET['key'], '<span class="red">'.$_GET['key'].'</span>', $_value->keyword);
                }
            }
            $_object=Tool::none($_object, 'thumbnail');
            $this->_tpl->assgin('SearchContent',$_object);
        }
    }
    public function getTag(){
        $_tag=new TagModel();
        $this->_tpl->assgin('fivetag',$_tag->getFiveTag());
    }
    //tag标签搜索
    private function searchTag(){
        if($_GET['type']==3){
             $this->_model->search=$_GET['key'];
             $_object=$this->_model->searchTagContent();
             if(!$_object)Tool::alertBack('没有此tag标签');
             $_tag=new TagModel();
             $_tag->name=$_GET['key'];
             if($_tag->checkTag()){
                 
                 $_tag->countTag();
             }else {
                 $_tag->addTag();
             }
             parent::page($this->_model->searchTagTotal());
             Tool::subStr($_object,'info',130, 'utf-8');
             $_object=Tool::none($_object, 'thumbnail');
             $this->_tpl->assgin('SearchContent',$_object);
        }
    }
    private function getSearch(){
        switch ($_GET['type']){
            case '1':
                $this->_tpl->assgin('Search','按标题查询: <span style="color:#333">'.$_GET['key']).'<span>';
                break;
            case '2':
                $this->_tpl->assgin('Search','按关键字查询: <span style="color:#333">'.$_GET['key']).'<span>';
                break;
            case '3':
                $this->_tpl->assgin('Search','按Tag标签查询: <span style="color:#333">'.$_GET['key']).'<span>';
                break;
        }
    }
    //加载侧栏数据
    private function sideBar(){
        //推荐
        $_object=$this->_model->getSearchMonthRec();
        Tool::objDate($_object,'date');
        $this->_tpl->assgin('MonthNavRec',$_object);
        //热点
        $_object=$this->_model->getSearchMonthHot();
        Tool::objDate($_object,'date');
        $this->_tpl->assgin('MonthNavHot',$_object);
        //图文
        $_object=$this->_model->getSearchMonthPic();
        Tool::objDate($_object,'date');
        $this->_tpl->assgin('MonthNavPic',$_object);
    }
}

?>
