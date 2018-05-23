<?php

    class Templates{
        //验证目录是否存在 
        private $_config=array();
        private $_vars=array();
        private $_cache=null;
       public function __construct($_cache=null){
         if(!is_dir(TPL_DIR)||!is_dir(TPL_C_DIR)||!is_dir(CACHE)){
             exit('ERROR:目录错误');
         }
         $_sxe=simplexml_load_file(ROOT_PATH.'/config/profile.xml');
         $_tagLib=$_sxe->xpath('/root/taglib');
         foreach ($_tagLib as $_tag){
            $this->_config["$_tag->name"]=$_tag->value;
         }
         $this->_cache=$_cache;
       }
       
       //注入方法
        
       public function assgin($_var,$_value){
           if (isset($_var)&&!empty($_var)){
               $this->_vars[$_var]=$_value;
           }else {
               exit('ERROR---注入字段名不能为空');
           }
       }
       
       //display 
       public function display($_file){
           $_tpl=$this;
           $_tplFile= TPL_DIR.$_file.'.php';
           if(!file_exists($_tplFile)){
               exit('Can\'t find '.$_file.'.php');
           } 
           //是否加入参数 
           if (!empty($_SERVER["QUERY_STRING"]))$_file_agument=$_SERVER["QUERY_STRING"];
           
           $_parFile=TPL_C_DIR.md5($_file.'fq').$_file.'.php';
           $_cacheFile=CACHE.md5($_file.'fq').$_file.$_file_agument.'.html';
           
           //编译文件不存在或模板改编生成编译文件
           if (!file_exists($_parFile)||filemtime($_parFile)<filemtime($_tplFile)){
               //模板解析
               require_once  ROOT_PATH.'/includes/Parser.class.php';
               $_parser=new Parser($_tplFile);
               $_parser->compile($_parFile);
               
           }
           
           include $_parFile;
           //获取缓冲区数据并创建缓存文件
           if(IS_CACHE&&!$this->_cache){
               file_put_contents($_cacheFile,ob_get_contents());
               ob_end_clean();
               include $_cacheFile;
           }
       } 
       //缓存方法跳转到缓存文件
       public function cache($_file){
           $_tplFile= TPL_DIR.$_file.'.php';
           if(!file_exists($_tplFile)){
               exit('Can\'t find '.$_file.'.php');
           }
           //是否加入参数
           if (!empty($_SERVER["QUERY_STRING"]))$_file.=$_SERVER["QUERY_STRING"];
           
           $_parFile=TPL_C_DIR.md5($_file.'fq').$_file.'.php';
           $_cacheFile=CACHE.md5($_file.'fq').$_file.'.html';
           if (IS_CACHE){
               if (file_exists($_cacheFile)&&file_exists($_parFile)){
                   if(filemtime($_parFile)>=filemtime($_tplFile)&&filemtime($_cacheFile)>filemtime($_parFile)){
                       include $_cacheFile;
                       exit();
                   }
               }
           }
       }
       //create 不生成缓存文件
       public function create($_file){
           $_tplFile= TPL_DIR.$_file.'.php';
           if(!file_exists($_tplFile)){
               exit('Can\'t find '.$_file.'.php');
           }
           $_parFile=TPL_C_DIR.md5($_file.'fq').$_file.'.php';
           //编译文件不存在或模板改编生成编译文件
           if (!file_exists($_parFile)||filemtime($_parFile)<filemtime($_tplFile)){
               //模板解析
               require_once  ROOT_PATH.'/includes/Parser.class.php';
               $_parser=new Parser($_tplFile);
               $_parser->compile($_parFile);
           }
           include $_parFile;
       }
       
    }
?>