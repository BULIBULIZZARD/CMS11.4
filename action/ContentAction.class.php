<?php

class ContentAction extends Action
{

    // 构造方法
    public function __construct(&$_tpl)
    {
        parent::__construct($_tpl, new ContentModel());
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
        $this->_tpl->assgin('show', true);
        $this->_tpl->assgin('title','文档列表');
        
        $_nav=new NavModel();
        if (empty($_GET['nav'])){
            
            $_id=$_nav->getAllNavChildId();
            $this->_model->nav=Tool::objArrOfStr($_id, 'id');
            $this->nav();
        }else {
            $_nav->_id=$_GET['nav'];
            ini_set("display_errors", "On");
            if (!is_numeric($_GET['nav']))Tool::alertBack('ERROR---BAD NAV ID');
            if(!$_nav->getOneNav(false))Tool::alertBack('ERROR---BAD NAV ID');
            $this->_model->nav=$_nav->_id;
            $this->nav($_nav->_id);
        }
        
        parent::page($this->_model->getListContentTotal());
        $_content=$this->_model->getListContent();
        Tool::subStr($_content,'title',20,'utf-8');
        $this->_tpl->assgin('SearchContent',$_content);
    }
    private function add()
    {
        
        if(isset($_POST['send'])){
            $this->getPost();
            $this->_model->addContent()?Tool::alertLocation('文档发布成功','?action=show'):Tool::alertBack('发布失败请重试');
            
        }
        
        $this->_tpl->assgin('add', true);
        $this->_tpl->assgin('title','新增文档');
        $this->nav(); 
        $this->_tpl->assgin('author',$_SESSION['admin']['admin_user']);
        //$this->_tpl->assgin('',$_nav->getAllChildFrontNav());
    }
    
    //attr显示
    private function attr($_attr){
        $_attrArr=array('头条','推荐','加粗','转跳');
        $_attrS=explode(',', $_attr);
        foreach ($_attrArr as $_value){
            in_array($_value,$_attrS)?$_check='checked="checked"':$_check='';
            $_html.="<input type=\"checkbox\" $_check name=\"attr[]\" value=".$_value.">$_value";
        }         
        $this->_tpl->assgin('attr',$_html);
    }
    private function nav($_n=0){
        $_nav=new NavModel();
        foreach ($_nav->getAllFrontNav() as $_object){
            $_html.='<optgroup label="'.$_object->nav_name.'">'."\r\n";
            $_nav->_pid=$_object->id;
            $_getChild=$_nav->getAllChildFrontNav();
            if($_getChild){
                foreach ($_getChild as $_object){
                    $_n==$_object->id?$_select="selected=seleced":$_select=null;
                    $_html.='<option value="'.$_object->id.'"  '.$_select.' >'.$_object->nav_name.'</option>'."\r\n";
                }
            }
            $_html.='</optgroup>'."\r\n";;
        }
        $this->_tpl->assgin('nav',$_html);
    }
    
    private function color($_colors){
        
        $_colorArr=array('#333'=>'默认颜色','#f00'=>'红色','#00f'=>'蓝色','#f60'=>'橙色');
        foreach ($_colorArr as $_key=>$_value){
            $_colors==$_key?$_select="selected=seleced":$_select=null;
            $_html.='<option value="'.$_key.'" '.$_select.' style="color:'.$_key.';">'.$_value.'</option>';
        }
        $this->_tpl->assgin('color',$_html);
    }
    private function sort($_sort){
        
        $_sortArr=array('0'=>'默认排序','1'=>'置顶一天','2'=>'置顶一周','3'=>'置顶一月','4'=>'置顶一年');
        foreach ($_sortArr as $_key=>$_value){
            $_sort==$_key?$_select="selected=seleced":$_select=null;
            $_html.='<option '.$_select.' value="'.$_key.'">'.$_value.'</option>';
        }
        $this->_tpl->assgin('sort',$_html);
    }
    private function readlimit($_readlimit){
        
        $_readArr=array('0'=>'开放浏览','1'=>'初级会员','2'=>'中级会员','3'=>'高级会员','4'=>'vip会员');
        foreach ($_readArr as $_key=>$_value){
            $_readlimit==$_key?$_select="selected=seleced":$_select=null;
            $_html.='<option '.$_select.' value="'.$_key.'">'.$_value.'</option>';
        }
        $this->_tpl->assgin('readlimit',$_html);
    }
    private function commend($_commend){
        $_commend?$this->_tpl->assgin('commend1','checked="checked"'):$this->_tpl->assgin('commend2','checked="checked"');
    }
    private function update()
    {
        if(isset($_POST['send'])){
            $this->_model->id=$_POST['id'];
            $this->getPost();
            $this->_model->updateContent()?Tool::alertLocation('文档修改成功',$_POST['prev_url']):Tool::alertBack('修改失败请重试');
            
        }
        if (!isset($_GET['id'])||empty($_GET['id']))Tool::alertBack('ERROR---ID_IS_EMPTY!!');
        $this->_tpl->assgin('update', true);
        $this->_tpl->assgin('title','修改文档');
        $this->_model->id=$_GET['id'];
        $_content=$this->_model->getOneContent();
        if(!$_content)Tool::alertBack('ERROR---ID_IS_WRONG!!');
        $this->_tpl->assgin('id',$_content->id);
        $this->_tpl->assgin('titlec',$_content->title);
        $this->_tpl->assgin('tag',$_content->tag);
        $this->_tpl->assgin('keyword',$_content->keyword);
        $this->_tpl->assgin('info',$_content->info);
        $this->_tpl->assgin('thumbnail',$_content->thumbnail);
        $this->_tpl->assgin('source',$_content->source);
        $this->_tpl->assgin('author',$_content->author);
        $this->_tpl->assgin('count',$_content->count);
        $this->_tpl->assgin('gold',$_content->gold);
        $this->_tpl->assgin('content',$_content->content);
        $this->_tpl->assgin('prev_url',PREV_URL);
        $this->nav($_content->nav);
        $this->attr($_content->attr);
        $this->color($_content->color);
        $this->sort($_content->sort);
        $this->readlimit($_content->readlimit);
        $this->commend($_content->commend);
    }
    private function getPost(){
        Validate::checkNull($_POST['title'])?Tool::alertBack('标题不能为空'):true;
        Validate::checkLength($_POST['title'],2,true)?Tool::alertBack('标题长度不能为小于两位'):true;
        Validate::checkLength($_POST['title'],50,false)?Tool::alertBack('标题长度不能大于五十位'):true;
        Validate::checkNull($_POST['nav'])?Tool::alertBack('请选择栏目'):true;
        Validate::checkLength($_POST['tag'],30,false)?Tool::alertBack('标签总长度不能大于三十位 '):true;
        Validate::checkLength($_POST['keyword'],30,false)?Tool::alertBack('关键字总长度不能大于三十位 '):true;
        Validate::checkLength($_POST['source'],20,false)?Tool::alertBack('文章来源长度不能大于二十位 '):true;
        Validate::checkLength($_POST['author'],10,false)?Tool::alertBack('作者名不能大于10位'):true;
        Validate::checkLength($_POST['info'],200,false)?Tool::alertBack('内容简介不能超过200个字符'):true;
        Validate::checkNull($_POST['content'])?Tool::alertBack('文章内容不能为空'):true;
        Validate::checkNum($_POST['count'])?Tool::alertBack('浏览次数只能为数字'):true;
        Validate::checkNum($_POST['gold'])?Tool::alertBack('金币只能为数字'):true;
        
        if(isset($_POST['attr'])){
            $this->_model->attr=implode(',', $_POST['attr']);
        }else {
            $_attr='无属性';
        }
        $this->_model->title= $_POST['title'];
        $this->_model->nav= $_POST['nav'];
        $this->_model->tag= $_POST['tag'];
        $this->_model->keyword= $_POST['keyword'];
        $this->_model->thumbnail= $_POST['thumbnail'];
        $this->_model->info= $_POST['info'];
        $this->_model->source= $_POST['source'];
        $this->_model->author= $_POST['author'];
        $this->_model->content=$_POST['content'];
        $this->_model->commend=$_POST['commend'];
        $this->_model->count=$_POST['count'];
        $this->_model->gold=$_POST['gold'];
        $this->_model->color=$_POST['color'];
        $this->_model->sort=$_POST['sort'];
        $this->_model->readlimit=$_POST['readlimit'];
    }
    private function delete()
    {
        
        empty($_GET['id'])?Tool::alertBack('ERROR---DON\'T_GET_ID'):true;
        $this->_model->id=$_GET['id'];
        $this->_model->deleteContent()?Tool::alertLocation('文档删除成功',PREV_URL):Tool::alertBack('删除失败请重试');
        
    }
}

?>
