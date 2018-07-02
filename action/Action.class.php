<?php
    //控制器基类
    class Action{
        protected $_tpl;
        protected $_model;
        
        protected function __construct(&$_tpl,&$_model=null){
            $this->_tpl=$_tpl;
            $this->_model=$_model;
            
        }
        
        protected function page($_total,$_pagesize=PAGE_SIZE){
            $_page=new Page($_total,$_pagesize);
            $this->_model->_limit=$_page->limit;
            $this->_tpl->assgin('page',$_page->showpage());
            $this->_tpl->assgin('num',($_page->page-1)*PAGE_SIZE);
        }
    }
?>