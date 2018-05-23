<?php

    class AdverAction extends Action{
  
        //构造方法
        public function __construct(&$_tpl){
            parent::__construct($_tpl, new AdverModel());
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
                case 'text':
                    $this->text();
                    break;
                case 'header':
                    $this->header();
                    break;
                case 'sidebar':
                    $this->sidebar();
                    break;
                default:
                    Tool::alertBack('非法操作');
                    break;
            }
        }
        
        private function text(){
            $_object=$this->_model->getNewTextAdver();
            $_js.="//".date("Y-m-d H:i:s",time())."\r\n"; 
            $_js.="var text=[];"."\r\n";
            $_i=0;
            foreach ($_object as $_value){
                $_i++;
                $_js.="text[$_i]={"."\r\n";
                $_js.="'title':'$_value->title',"."\r\n";
                $_js.="'link':'$_value->link'"."\r\n";
                $_js.="}"."\r\n";
            }
            $_js.="var i=Math.floor(Math.random()*$_i+1);"."\r\n";
            $_js.="document.write('<a href=\"'+text[i].link+'\" class=\"adv\"  target=\"_blank\">'+text[i].title+'</a>');"."\r\n";
            if(!file_put_contents('../js/text_adver.js', $_js)){
                Tool::alertBack('ERROR_WRONG_TO_CREATE_JS');
            }
            Tool::alertLocation('成功生成文字广告js','?action=show');
        }
        private function header(){
            $_object=$this->_model->getNewHeaderAdver();
            $_js.="//".date("Y-m-d H:i:s",time())."\r\n";
            $_js.="var header=[];"."\r\n";
            $_i=0;
            foreach ($_object as $_value){
                $_i++;
                $_js.="header[$_i]={"."\r\n";
                $_js.="'title':'$_value->title',"."\r\n";
                $_js.="'pic':'$_value->thumbnail',"."\r\n";
                $_js.="'link':'$_value->link'"."\r\n";
                $_js.="}"."\r\n";
            }
            $_js.="var i=Math.floor(Math.random()*$_i+1);"."\r\n";
            $_js.="document.write('<a href=\"'+header[i].link+'\" target=\"_blank\" title=\"'+header[i].title+'\"><img src=\"'+header[i].pic+'\" >');"."\r\n";
            if(!file_put_contents('../js/header_adver.js', $_js)){
                Tool::alertBack('ERROR_WRONG_TO_CREATE_JS');
            }
            Tool::alertLocation('成功生成文字广告js','?action=show');
        }
        private function sidebar(){
            $_object=$this->_model->getNewSidebarAdver();
            $_js.="//".date("Y-m-d H:i:s",time())."\r\n";
            $_js.="var sidebar=[];"."\r\n";
            $_i=0;
            foreach ($_object as $_value){
                $_i++;
                $_js.="sidebar[$_i]={"."\r\n";
                $_js.="'title':'$_value->title',"."\r\n";
                $_js.="'pic':'$_value->thumbnail',"."\r\n";
                $_js.="'link':'$_value->link'"."\r\n";
                $_js.="}"."\r\n";
            }
            $_js.="var i=Math.floor(Math.random()*$_i+1);"."\r\n";
            $_js.="document.write('<a href=\"'+sidebar[i].link+'\" target=\"_blank\" title=\"'+sidebar[i].title+'\"><img src=\"'+sidebar[i].pic+'\" >');"."\r\n";
            if(!file_put_contents('../js/sidebar_adver.js', $_js)){
                Tool::alertBack('ERROR_WRONG_TO_CREATE_JS');
            }
            Tool::alertLocation('成功生成文字广告js','?action=show');
        }
        private function state(){
            isset($_GET['id'])?true:Tool::alertBack('ERROR---EMPTY_COMMENT_ID');
            $this->_model->id=$_GET['id'];
            if(!$this->_model->getOneAdver())Tool::alertBack('ERROR---WORNG_ADVER_ID');
            if ($_GET['type']=='ok'){
                $this->_model->setStateOk()?Tool::alertLocation(null,PREV_URL):Tool::alertBack('操作失败请重试');
            }else if($_GET['type']=='notok'){
                $this->_model->setStateNotOk()?Tool::alertLocation(null,PREV_URL):Tool::alertBack('操作失败请重试');
            }else{
                Tool::alertBack('ERROR---WRONG_TYPE');
            }
        }
        private function show(){
            
            if(!isset($_GET['kind'])||empty($_GET['kind'])){
                $this->_model->kind='1,2,3';
            }
            else{
                $this->_model->kind=$_GET['kind'];
                $_selected='selected="selected"';
                switch ($_GET['kind']){
                    case 1:
                        $this->_tpl->assgin('select1',$_selected);
                        break;
                    case 2:
                        $this->_tpl->assgin('select2',$_selected);
                        break;
                    case 3:
                        $this->_tpl->assgin('select3',$_selected);
                        break;
                }
            }
            
            parent::page($this->_model->getAdverTotal());
            $this->_tpl->assgin('show',true);
            $this->_tpl->assgin('title','广告列表');
            $_object=$this->_model->getAllAdver();
            Tool::subStr($_object,'link', 20, 'utf-8');
            foreach ($_object as $_value){
                $_value->state?$_value->state='<span class="green">是</span>':$_value->state='<span class="red">否</span>';
                switch ($_value->type){
                    case 1:
                        $_value->type='文字广告';
                        break;
                    case 2:
                        $_value->type='头部广告690x80';
                        break;
                    case 3:
                        $_value->type='侧栏广告270x200';
                        break;
                }
            }
            $this->_tpl->assgin('AllAdver',$_object);
        }
        
        private function add(){
            if(isset($_POST['send'])){
                $this->_model->type=$_POST['type'];
                if(Validate::checkNull($_POST['title']))Tool::alertBack('标题不能为空');
                if(Validate::checkLength($_POST['title'],2, true))Tool::alertBack('标题不能小于两位');
                if(Validate::checkLength($_POST['title'],20, false))Tool::alertBack('标题不能大于二十位');
                if(Validate::checkNull($_POST['link']))Tool::alertBack('链接不能为空');
                if(Validate::checkLength($_POST['link'],100, false))Tool::alertBack('链接不能大于100位');
                if($_POST['type']!='1'){
                    if(Validate::checkNull($_POST['thumbnail']))Tool::alertBack('请上传一个图片');
                }
                if(Validate::checkLength($_POST['info'],200, false))Tool::alertBack('广告信息不能超过 二百位');
                $this->_model->title=$_POST['title'];
                $this->_model->link=$_POST['link'];
                $this->_model->thumbnail=$_POST['thumbnail'];
                $this->_model->info=$_POST['info'];
                $this->_model->type=$_POST['type'];
                $this->_model->addAdver()?Tool::alertLocation('新增成功','adver.php?action=show'):Tool::alertBack('新增失败请重试!');
            }
            $this->_tpl->assgin('add', true);
            $this->_tpl->assgin('title','新增广告');
            $this->_tpl->assgin('prev_url',PREV_URL);
        }
        private function update(){
            if(isset($_POST['send'])){
                $this->_model->type=$_POST['type'];
                if(Validate::checkNull($_POST['title']))Tool::alertBack('标题不能为空');
                if(Validate::checkLength($_POST['title'],2, true))Tool::alertBack('标题不能小于两位');
                if(Validate::checkLength($_POST['title'],20, false))Tool::alertBack('标题不能大于二十位');
                if(Validate::checkNull($_POST['link']))Tool::alertBack('链接不能为空');
                if(Validate::checkLength($_POST['link'],100, false))Tool::alertBack('链接不能大于100位');
                if($_POST['type']!='1'){
                    if(Validate::checkNull($_POST['thumbnail']))Tool::alertBack('请上传一个图片');
                }
                if(Validate::checkLength($_POST['info'],200, false))Tool::alertBack('广告信息不能超过 二百位');
                $this->_model->title=$_POST['title'];
                $this->_model->link=$_POST['link'];
                $this->_model->thumbnail=$_POST['thumbnail'];
                $this->_model->id=$_POST['id'];
                $this->_model->info=$_POST['info'];
                $this->_model->type=$_POST['type'];
                $this->_model->updateAdver()?Tool::alertLocation('更新成功','adver.php?action=show'):Tool::alertBack('更新失败请重试!');
            }
            if (!isset($_GET['id'])||empty($_GET['id']))Tool::alertBack('ERROR---ID_IS_EMPTY!!');
            $this->_model->id=$_GET['id'];
            $_adver=$this->_model->getAdver();
            if(!$_adver)Tool::alertBack('ERROR---WRONG_ADVER_ID');
            $this->_tpl->assgin('titlec',$_adver->title);
            $this->_tpl->assgin('link',$_adver->link);
            $this->_tpl->assgin('info',$_adver->info);
            $this->_tpl->assgin('id',$_adver->id);
            $this->_tpl->assgin('thumbnail',$_adver->thumbnail);
            switch ($_adver->type){
                case 1:
                    $this->_tpl->assgin('type1','checked="checked"');
                    $this->_tpl->assgin('pic','style="display: none;"');
                    break;
                case 2:
                    $this->_tpl->assgin('type2','checked="checked"');
                    $this->_tpl->assgin('pic','style="display: block;"');
                    $this->_tpl->assgin('up',"<input type=\"button\" value=\"上传头部广告690x80\" onclick=\"centerWindow('../config/upfile.php?type=adver&size=690x80','upfile','500','100');\">");
                    break;
                case 3:
                    $this->_tpl->assgin('type3','checked="checked"');
                    $this->_tpl->assgin('pic','style="display: block;"');
                    $this->_tpl->assgin('up',"<input type=\"button\" value=\"上传侧栏广告270x200\" onclick=\"centerWindow('../config/upfile.php?type=adver&size=270x200','upfile','500','100');\">");
                    break;
            }
            
            $this->_tpl->assgin('title','更新广告信息');
            $this->_tpl->assgin('update', true);
            $this->_tpl->assgin('prev_url',PREV_URL);
        }
        private function delete(){
            if (isset($_GET['id'])){
                $this->_model->id=$_GET['id'];
                $this->_model->deleteAdver()?Tool::alertLocation('删除成功',PREV_URL):Tool::alertBack('删除失败');
            }else {
                Tool::alertBack('DELETE----非法操作');
            }
        }        
    }
   

?>
