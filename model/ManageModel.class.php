<?php

    //管理员实体类
    class ManageModel extends Model{
       
        private $id;
        private $_admin_user;
        private $_admin_pass;
        private $_level;
        private $_limit;
        private $_last_ip;
        
        
        //拦截器get set
        public function __set($_key,$_value){
            $this->$_key=Tool::mysqlString($_value);
        }
        public function __get($_key){
            return $this->$_key;
        }
      
        //登陆统计  
        public function setLoginCount(){
            $_sql="UPDATE 
                        cms_manage 
                    SET 
                        login_count=login_count+1,
                        last_ip='$this->_last_ip',
                        last_time=NOW() 
                  WHERE 
                        admin_user='$this->_admin_user' 
                  LIMIT 
                        1";
            return parent::aud($_sql);
        }
        //获取总记录
        public function getManageTotal(){
            $_sql="SELECT COUNT(*) FROM cms_manage";
            return parent::total($_sql);
        }
        
        //查询登陆管理员
        public function getLoginManage(){
            $_sql="SELECT 
                                m.admin_user,
                                l.level_name,
                                l.premission
                       FROM 
                                cms_manage  m ,
                                cms_level  l
                       WHERE 
                                admin_user='$this->_admin_user'
                        AND 
                                admin_pass='$this->_admin_pass' 
                         AND
                                m.level=l.id
                       LIMIT 
                                1 ";

            return parent::one($_sql);
        }
        public function getOneManage(){
            $_sql="SELECT 
                            id,
                            admin_user,
                            level 
                       FROM
                            cms_manage
                      WHERE
                            id='$this->id' 
                        OR
                            admin_user='$this->_admin_user'
                        OR 
                            level='$this->_level'
                      LIMIT 
                            1";
           return parent::one($_sql);
            
        }
        //查询 
        public function getManage(){
            
            $_sql="SELECT
                          m.id as mid,
                          m.admin_user,
                          m.login_count,
                          m.last_ip,
                          m.last_time,
                          l.id,
                          l.level_name
                   FROM
                          cms_manage m,
                          cms_level l
                   WHERE
                          m.level=l.id
                   ORDER BY
                          m.id DESC
                      $this->_limit";
            
                            
            return parent::selectall($_sql);
        }
        
        //新增
        public function addManage(){
            
            $_sql="INSERT INTO 
                            cms_manage
                                    (
                                        admin_user,
                                        admin_pass,
                                        level,
                                        reg_time
                                    )
                            VALUES
                                    (
                                        '$this->_admin_user',
                                        '$this->_admin_pass',
                                        '$this->_level',
                                        NOW()
                                    )";
          return parent::aud($_sql);
        }
        
        //修改
        public function updateManage($_flag){
           
            if ($_flag){
                    $_sql="UPDATE 
                                cms_manage 
                            SET 
                                admin_pass='$this->_admin_pass',
                                level ='$this->_level'
                          WHERE 
                                id='$this->id' 
                          LIMIT 
                                1";
            }else 
            {
                $_sql="UPDATE
                          cms_manage
                      SET
                          level ='$this->_level'
                    WHERE
                          id='$this->id'
                    LIMIT
                           1";
            }
            return parent::aud($_sql);
        }
        
        //删除
        public function deleteManage(){
            $_sql="DELETE FROM cms_manage WHERE id='$this->id' LIMIT 1";
            return parent::aud($_sql); 
        }
    }
?>
