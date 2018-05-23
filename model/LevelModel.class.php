<?php

    //等级实体类
    class LevelModel extends Model{
       
        private $id;
        private $_level_name;
        private $_level_info;
        private $premission;
        private $_limit;
        
        
        
        //拦截器get set
        public function __set($_key,$_value){
            $this->$_key=Tool::mysqlString($_value);
        }
        public function __get($_key){
            return $this->$_key;
        }
      
        public function isLevel(){
            $_sql="SELECT
            id,
            level_name,
            level_info
            FROM
            cms_Level
            WHERE
            
            level_name='$this->_level_name'
            AND
            id='$this->id'
            LIMIT
            1";
            return parent::one($_sql);
        }
        
        
        public function getOneLevel($_flag){
            if($_flag){
            $_sql="SELECT 
                            id,
                            level_name,
                            level_info,
                            premission 
                       FROM
                            cms_Level
                      WHERE
                            
                            level_name='$this->_level_name'
                      LIMIT 
                            1";
           
            }else {
                $_sql="SELECT
                                id,
                                level_name,
                                level_info,
                                premission 
                            FROM
                                cms_Level
                           WHERE
                                id='$this->id'
                           LIMIT
                                1";
            }
            return parent::one($_sql);
        }
        
       
        public function getLevelTotal(){
            $_sql="SELECT COUNT(*) FROM cms_level";
            return parent::total($_sql);
        }
        //查询 
        public function getAllLevel(){
            
            $_sql="SELECT
                          id,
                          level_name,
                          level_info 
                   FROM
                          cms_level 
                   ORDER BY
                          id DESC
                           ";
                            
            return parent::selectall($_sql);
        }
        
        public function getAllLimitLevel(){
            
            $_sql="SELECT
                          id,
                          level_name,
                          level_info,
                          premission
                   FROM
                          cms_level
                   ORDER BY
                          id DESC
                         $this->_limit ";
            
            return parent::selectall($_sql);
        }
        
        //新增
        public function addLevel(){
            $_sql="INSERT INTO 
                            cms_Level
                                    (
                                        level_name,
                                        level_info,
                                        premission 
                                    )
                            VALUES
                                    (
                                        '$this->_level_name',
                                        '$this->_level_info',
                                        '$this->premission'
                                    )";
          return parent::aud($_sql);
        }
        
        //修改
        public function updateLevel(){
           
            $_sql="UPDATE 
                            cms_Level 
                        SET 
                            level_name='$this->_level_name',
                            level_info ='$this->_level_info',
                            premission='$this->premission'
                      WHERE 
                            id='$this->id' 
                      LIMIT 
                            1";
            return parent::aud($_sql);
        }
        
        //删除
        public function deleteLevel(){
           
            $_sql="DELETE FROM cms_Level WHERE id='$this->id' LIMIT 1";
            return parent::aud($_sql); 
        }
    }
?>
