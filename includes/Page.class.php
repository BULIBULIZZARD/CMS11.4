<?php
    
    class Page{
        private $total;
        private $pazesize;
        private $limit;
        private $page;
        private $pagenum;
        private $url;
        private $bothnum;
        
        public function __construct($_total,$_pagesize){
            $_total==0?$this->total=1:$this->total=$_total;
            $this->pazesize=$_pagesize;
            $this->pagenum=ceil($this->total/$this->pazesize);
            $this->page=$this->setPage(); 
            $this->limit="LIMIT ".(($this->page-1)*$this->pazesize).",".($this->pazesize);
            $this->url=$this->setUrl();
            $this->bothnum=2;
        }
        public function __get($_key){
            return $this->$_key;
        }
        public function setPage(){
            if(!empty($_GET['page'])){
                    if($_GET['page']>1){
                        if ($_GET['page']<$this->pagenum){
                            return $_GET['page'];
                        }else {
                            return $this->pagenum;
                        }
                        
                    }else {
                        return 1;
                    }
            }else {
                return 1;
            }
        }
        //获取地址
        private function setUrl(){
            $_url= $_SERVER["REQUEST_URI"];
            $_par=parse_url($_url);
            if(isset($_par['query'])){
                parse_str($_par['query'],$_query);
                unset($_query['page']);
                $_url=$_par['path'].'?'.http_build_query($_query);
                
            }
            
            return $_url;
        }
        private function pageList(){
            for ($i=$this->page-$this->bothnum;$i<$this->page;$i++){
                $_page=$i; 
                if ($i<1)continue;
                $_pagelist.='<a href="'.$this->url.'&page='.$_page.'">'.$_page.'</a>';
            }
            $_pagelist.='<span class="me">'.$this->page.'</span>';
            for ($i=1;$i<=$this->bothnum;$i++){
                $_page=$this->page+$i;
                if($_page>$this->pagenum)break;
                $_pagelist.='<a href="'.$this->url.'&page='.$_page.'">'.$_page.'</a>';
                    
                
            }
//             for($i=1;$i<=$this->pagenum;$i++){
//                 if($i==$this->page){
//                     $_pagelist.='<span class="disabled">'.$i.'</span>';
//                     continue;
//                 }
//                 $_pagelist.='<a href="'.$this->url.'&page='.$i.'">'.$i.'</a>';
//             }
            return $_pagelist;
        }
        private function first(){
            if($this->page>$this->bothnum+1){
                if($this->page>$this->bothnum+2){
                    return '<a href="'.$this->url.'">1</a>...';
                }
                return '<a href="'.$this->url.'">1</a>';
                
                
            }
           
        }
        private function prev(){
            if ($this->page==1){
                return '<span class="disabled">上一页</span>';
            }
            return '<a href="'.$this->url.'&page='.($this->page-1).'">上一页</a>';
        }
        private function next(){
            if($this->page==$this->pagenum){
                return '<span class="disabled">下一页</span>';
            }
            return '<a href="'.$this->url.'&page='.($this->page+1).'">下一页</a>';
        }
        private function last(){
            if($this->page<$this->pagenum-$this->bothnum){
                if($this->page<$this->pagenum-$this->bothnum-1){
                    return '...<a href="'.$this->url.'&page='.$this->pagenum.'">'.$this->pagenum.'</a>';
                }
                return '<a href="'.$this->url.'&page='.$this->pagenum.'">'.$this->pagenum.'</a>';
            }
            
        }
        
        public function showpage(){
            $_page.=$this->first();
            $_page.=$this->pageList();
            $_page.=$this->last();
            $_page.=$this->prev();
            $_page.=$this->next();
            return $_page;
        }
    }
?>