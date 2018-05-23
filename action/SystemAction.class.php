<?php

    class SystemAction extends Action{
  
        //构造方法
        public function __construct(&$_tpl){
            parent::__construct($_tpl, new SystemModel());
        }
        public function _action(){
            $this->update();
            $this->show();
        }
        
        private function update(){
            if(isset($_POST['send'])){
                if(Validate::checkNull($_POST['webname']))Tool::alertBack('网站名称不能为空');
                if(Validate::checkLength($_POST['webname'],20,false))Tool::alertBack('网站名称不能大于二十位');
                if(Validate::checkNull($_POST['page_size']))Tool::alertBack('常规分页不能为空');
                if(Validate::checkNum($_POST['page_size']))Tool::alertBack('分页数应为整数');
                if(Validate::checkLength($_POST['page_size'],2,false))Tool::alertBack('请设置小于100的分页数');  
                if(Validate::checkNull($_POST['article_size']))Tool::alertBack('文档分页不能为空');
                if(Validate::checkNum($_POST['article_size']))Tool::alertBack('文档分页数应为整数');
                if(Validate::checkLength($_POST['article_size'],2,false))Tool::alertBack('请设置小于100的文档分页数');  
                if(Validate::checkNull($_POST['nav_size']))Tool::alertBack('导航个数不能为空');
                if(Validate::checkNum($_POST['nav_size']))Tool::alertBack('导航个数应为整数');
                if(Validate::checkLength($_POST['nav_size'],2,false))Tool::alertBack('请设置小于100的文档导航个数'); 
                if(Validate::checkNull($_POST['updir']))Tool::alertBack('上传目录不能为空');
                if(Validate::checkNull($_POST['ro_num']))Tool::alertBack('轮播个数不能为空');
                if(Validate::checkNum($_POST['ro_num']))Tool::alertBack('轮播个数应为整数');
                if(Validate::checkNull($_POST['adver_text_num']))Tool::alertBack('文字广告个数不能为空');
                if(Validate::checkNum($_POST['adver_text_num']))Tool::alertBack('文字广告个数应为整数');
                if(Validate::checkNull($_POST['adver_pic_num']))Tool::alertBack('图片广告个数不能为空');
                if(Validate::checkNum($_POST['adver_pic_num']))Tool::alertBack('图片广告个数应为整数');
                $this->_model->webname=$_POST['webname'];
                $this->_model->page_size=$_POST['page_size'];
                $this->_model->article_size=$_POST['article_size'];
                $this->_model->nav_size=$_POST['nav_size'];
                $this->_model->updir=$_POST['updir'];
                $this->_model->ro_num=$_POST['ro_num'];
                $this->_model->adver_text_num=$_POST['adver_text_num'];
                $this->_model->adver_pic_num=$_POST['adver_pic_num'];
                if ($this->_model->setSystem())
                {
                    $_br="\r\n";
                    $_tab="\t";
                    $_profile='<?php'.$_br;
                    $_profile.=$_tab."define('WEBNAME', '{$this->_model->webname}');".$_br;
                    $_profile.=$_tab."define('PAGE_SIZE', {$this->_model->page_size});".$_br;
                    $_profile.=$_tab."define('ARTICLE_SIZE', {$this->_model->article_size});".$_br;
                    $_profile.=$_tab."define('NAV_SIZE', {$this->_model->nav_size});".$_br;
                    $_profile.=$_tab."define('UPDIR', '{$this->_model->updir}');".$_br;
                    $_profile.=$_tab."define('RO_NUM', {$this->_model->adver_text_num});".$_br;
                    $_profile.=$_tab."define('ADVER_TEXT_NUM', {$this->_model->adver_text_num});".$_br;
                    $_profile.=$_tab."define('ADVER_PIC_NUM', {$this->_model->adver_pic_num});".$_br;
                    $_profile.=$_tab."//不可变参数".$_br;
                    $_profile.=$_tab."define('DB_HOST', 'localhost'); //主机ip".$_br;
                    $_profile.=$_tab."define('DB_USER', 'root');".$_br;
                    $_profile.=$_tab."define('DB_PASS', 'root');".$_br;
                    $_profile.=$_tab."define('DB_NAME', 'cms');".$_br;
                    $_profile.=$_tab."define('GPC',get_magic_quotes_gpc());".$_br;
                    $_profile.=$_tab."define('PREV_URL', \$_SERVER[\"HTTP_REFERER\"]);".$_br;
                    $_profile.=$_tab."define('MARK',ROOT_PATH.'/images/sy.png');//水印".$_br;
                    $_profile.=$_tab."define('TPL_DIR', ROOT_PATH.'/templates/');//模板文件目录".$_br;
                    $_profile.=$_tab."define('TPL_C_DIR', ROOT_PATH.'/templates_c/');//编译文件目录".$_br;
                    $_profile.=$_tab."define('CACHE', ROOT_PATH.'/cache/');//缓存文件目录".$_br;
                    $_profile.='?>';
                    if(!file_put_contents('../config/profile.inc.php', $_profile)){
                        Tool::alertBack('生成配置文件失败');
                    }
                    Tool::alertLocation('生成配置文件成功','system.php');
                }else {
                    Tool::alertBack('修改配置文件失败,请重试');
                }
            }
        }
        private function show(){
            $_object=$this->_model->getSystem();
            $this->_tpl->assgin('twebname',$_object->webname);
            $this->_tpl->assgin('page_size',$_object->page_size);
            $this->_tpl->assgin('article_size',$_object->article_size);
            $this->_tpl->assgin('nav_size',$_object->nav_size);
            $this->_tpl->assgin('updir',$_object->updir);
            $this->_tpl->assgin('ro_num',$_object->ro_num);
            $this->_tpl->assgin('adver_text_num',$_object->adver_text_num);
            $this->_tpl->assgin('adver_pic_num',$_object->adver_pic_num);
        }
    }
   

?>
