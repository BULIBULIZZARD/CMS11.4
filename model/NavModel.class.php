<?php

    //导航实体类
    class NavModel extends Model{
       
        private $_id;
        private $_nav_name;
        private $_nav_info;
        private $_pid=0;
        private $_sort;
        private $_limit;
        
        
        //拦截器get set
        public function __set($_key,$_value){
            $this->$_key=Tool::mysqlString($_value);
        }
        public function __get($_key){
            return $this->$_key;
        }
      
        //获取前四个主导航  
        public function getFourNav(){
            $_sql="SELECT 
                        id,
                        nav_name 
                    FROM 
                        cms_nav 
                    WHERE 
                        pid=0 
                    ORDER BY 
                        sort 
                    ASC 
                    LIMIT 
                        0,4";
            return parent::selectall($_sql);
        }
        
        public function getFront(){
            $_sql="SELECT
            id,
            nav_name
            FROM
            cms_nav
            WHERE
            pid=0
            ORDER BY
            sort ASC
            LIMIT 0,".NAV_SIZE;
            return parent::selectall($_sql);  
        }
        //获取总记录
        public function getNavTotal(){
            $_sql="SELECT COUNT(*) FROM cms_nav WHERE pid=0 ";
            return parent::total($_sql);
        }
        public function getAllNav(){
            
            $_sql="SELECT
                          id,
                          nav_name,
                          nav_info,
                          sort
                   FROM
                          cms_nav
                   WHERE
                          pid=0
                        
                   ORDER BY
                          sort ASC
                        $this->_limit ";
            
            return parent::selectall($_sql);  
        }
        
        //获取所有非主类id
        public function getAllNavChildId(){
            $_sql="SELECT id FROM cms_nav WHERE pid<>0";
            return parent::selectall($_sql);
        }
        
        //获取子总记录
        public function getNavChildTotal(){
            $_sql="SELECT COUNT(*) FROM cms_nav WHERE pid='$this->_pid' ";
            return parent::total($_sql);
        }
        public function getAllChildNav(){
            
            $_sql="SELECT
            id,
            nav_name,
            nav_info,
            sort
            FROM
            cms_nav
            WHERE
            pid='$this->_pid'
            ORDER BY sort ASC
            $this->_limit ";
            
            return parent::selectall($_sql);
        }
        
        public function getAllFrontNav(){
            $_sql="SELECT
            id,
            nav_name,
            nav_info,
            sort
            FROM
            cms_nav
            WHERE
            pid=0
            ORDER BY sort ASC
            ";
            
            return parent::selectall($_sql);
        }
        
        //获取子类id
        public function getNavChildId(){
            $_sql="SELECT id FROM cms_nav WHERE pid='$this->_id'";
            return parent::selectall($_sql);
        }
        //所有子导航
        public function getAllChildFrontNav(){
            
            $_sql="SELECT
            id,
            nav_name,
            nav_info,
            sort
            FROM
            cms_nav
            WHERE
            pid='$this->_pid'
            ORDER BY sort ASC
            ";
            
            return parent::selectall($_sql);
        }
        
        //新增
        public function addNav(){
            $_sql="INSERT INTO
                                cms_nav
                                (
                                
                                    nav_name,
                                    nav_info,
                                    pid,
                                    sort
                                    )
                                VALUES
                                (
                                
                                    '$this->_nav_name',
                                    '$this->_nav_info',
                                    '$this->_pid',
                                    '".parent::nextId('cms_nav')."'
                                )";
            return parent::aud($_sql);
        }
              
        
        
        public function isNav(){
            $_sql="SELECT
            id,
            nav_name,
            nav_info
            FROM
            cms_nav
            WHERE
            
            nav_name='$this->_nav_name'
            AND
            id='$this->_id'
            LIMIT
            1";
            return parent::one($_sql);
        }
        
        public function getOneNav($_flag){
            if($_flag){
                $_sql="SELECT
                id,
                nav_name,
                nav_info
                FROM
                cms_nav
                WHERE
                nav_name='$this->_nav_name'
                LIMIT
                1";
                
            }else {
                $_sql="SELECT
                id,
                nav_name,
                nav_info,
                pid
                FROM
       
                cms_nav
                WHERE
                id='$this->_id'
                LIMIT
                1";
            }
            return parent::one($_sql);
        }
        //修改
        public function updateSort(){
            
            $_sql="UPDATE
            cms_nav
            SET
            sort='$this->_sort'
            WHERE
            id='$this->_id'
            LIMIT
            1";
            echo $_sql.'<br>';
            return parent::aud($_sql);
        }
        public function updateNav(){
            
            $_sql="UPDATE
            cms_nav
            SET
            nav_name='$this->_nav_name',
            nav_info ='$this->_nav_info'
            WHERE
            id='$this->_id'
            LIMIT
            1";
            return parent::aud($_sql);
        }
        public function deleteNav(){
            
            $_sql="DELETE FROM cms_nav WHERE id='$this->_id' LIMIT 1";
            return parent::aud($_sql);
        }
    }
?>
