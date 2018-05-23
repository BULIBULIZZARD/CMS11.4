<?php

    class MainAction extends Action{
  
        //构造方法
        public function __construct(&$_tpl){
            parent::__construct($_tpl);
        }
        public function _action(){
            if($_GET['action']=='delcache')$this->delCache();
            $this->cacheNum();
        }
        
        private function cacheNum(){
            $_dir=ROOT_PATH.'/cache/';
            $_num=sizeof(scandir($_dir));
            $this->_tpl->assgin('cacheNum',$_num-2);
        }
         
        private function delCache(){ 
            if(Validate::checkPremission(3, $_SESSION['admin']['premission']))Tool::alertBack('您没有清除缓存的权限');
            $_dir=ROOT_PATH.'/cache/';
            if(!$_dh=@opendir($_dir))return ;
            while (false!==($_obj=readdir($_dh))){
                if($_obj=='.'||$_obj=='..')continue;
                @unlink($_dir.'/'.$_obj);
            }
            closedir($_dh);
            Tool::alertLocation('清理缓存成功','main.php');
        }
    }
   

?>
