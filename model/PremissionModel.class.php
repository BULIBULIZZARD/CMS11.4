<?php

    //权限实体类
    class PremissionModel extends Model{
        private $id;
        private $name;
        private $info;
        private $_limit;
        
        //拦截器get set
        public function __set($_key,$_value){
            $this->$_key=Tool::mysqlString($_value);
        }
        public function __get($_key){
            return $this->$_key;
        }
        
        public function getPremissionTotal(){
            $_sql="SELECT COUNT(*) FROM cms_premission";
            return parent::total($_sql);
        }
        public function getAllPremission(){
            $_sql="SELECT 
                            id,
                            name,
                            info 
                        FROM 
                            cms_premission 
                        ORDER BY 
                            id 
                        DESC 
                            $this->_limit";
            return parent::selectall($_sql);
        }
        public function getPremission(){
            $_sql="SELECT
                        id,
                        name,
                        info
                    FROM
                        cms_premission
                    ORDER BY
                        id
                    ASC
                    ";
            return parent::selectall($_sql);
        }
        public function getOnePremission(){
            
            $_sql="SELECT
                            id,
                            name,
                            info    
                        FROM
                            cms_premission
                        WHERE 
                            id='$this->id'
                        LIMIT 1";
            return parent::one($_sql);
        }
        
        public function addPremission(){
            $_sql="INSERT 
                    INTO 
                        cms_premission 
                        (
                            name,
                            info
                        ) 
                    VALUES
                        (
                            '$this->name',
                            '$this->info'
                        )
                         ";
            return parent::aud($_sql);
        }
        public function updatePremission(){
            $_sql="UPDATE 
                        cms_premission 
                    SET 
                        name='$this->name',
                        info='$this->info' 
                    WHERE 
                        id='$this->id' 
                    LIMIT 1";
            return parent::aud($_sql);
        }
        public function checkPremission(){
            $_sql="SELECT id FROM cms_premission WHERE name='$this->name'";
            return parent::one($_sql);
        }
        public function deletePremission(){
            $_sql="DELETE FROM cms_premission WHERE id='$this->id' LIMIT 1";
            return parent::aud($_sql);
        }
    }
?>
