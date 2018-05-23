<?php

    //友情连接实体类
    class LinkModel extends Model{
        private $id;
        private $webname;
        private $weburl;
        private $logourl;
        private $user;
        private $type;
        private $state;
        private $_limit;
        //拦截器get set
        public function __set($_key,$_value){
            $this->$_key=Tool::mysqlString($_value);
        }
        public function __get($_key){
            return $this->$_key;
        }
        public function getLinkTotal(){
            $_sql="SELECT COUNT(*) FROM cms_link";
            return parent::total($_sql);
        }
        public function checkLink(){
            $_sql="SELECT id FROM cms_link WHERE id='$this->id'";
            return parent::one($_sql);
        }
        public function setStateOk(){
            $_sql="UPDATE
            cms_link
            SET
            state=1
            WHERE
            id='$this->id'
            ";
            echo $_sql;
            return parent::aud($_sql);
        }
        public function setStateNotOk(){
            $_sql="UPDATE
            cms_link
            SET
            state=0
            WHERE
            id='$this->id'
            ";
            return parent::aud($_sql);
        }
        public function getAllLink(){
                    $_sql="SELECT
                                id,
                                webname,
                                weburl wu,
                                weburl,
                                logourl lu,
                                logourl,
                                user,
                                type,
                                state
                            FROM
                                cms_link
                            ORDER BY
                                state DESC,
                                date DESC
                            $this->_limit ";
            return parent::selectall($_sql);
        }
        //新增
        public function addLink(){
            $_sql="INSERT INTO
                            cms_Link
                            (
                                webname,
                                weburl,
                                logourl,
                                user,
                                type,
                                state,
                                date
                            )
                            VALUES
                            (
                                '$this->webname',
                                '$this->weburl',
                                '$this->logourl',
                                '$this->user',
                                '$this->type',
                                '$this->state',
                                NOW()                            
                            )";
            return parent::aud($_sql);
        }
        public function getOneLink(){
            $_sql="SELECT 
                        id,
                        webname,
                        user,
                        weburl,
                        logourl,
                        type 
                    FROM 
                        cms_link 
                    WHERE 
                        id='$this->id' 
                    LIMIT 1";
            return parent::one($_sql);
        }
        public function updateLink(){
            $_sql="UPDATE 
                        cms_link 
                    SET 
                        webname='$this->webname',
                        weburl='$this->weburl',
                        logourl='$this->logourl',
                        user='$this->user',
                        type='$this->type' 
                    WHERE 
                        id='$this->id'
                    LIMIT 1
                    ";
            return parent::aud($_sql);
        }
        public function deleteLink(){
            $_sql="DELETE FROM cms_link WHERE id='$this->id' LIMIT 1";
            return parent::aud($_sql);
        }
        //显示前二十个过审的文字链接
        public function getTextLink(){
            $_sql="SELECT 
                        weburl,
                        webname 
                    FROM 
                        cms_link 
                    WHERE 
                        state=1 
                    AND
                        type=1
                    LIMIT 0,20";
            return parent::selectall($_sql);
        }
        
        public function getLogoLink(){
            $_sql="SELECT
                        weburl,
                        webname,
                        logourl
                    FROM
                        cms_link
                    WHERE
                        state=1
                    AND
                        type=2
                    LIMIT 0,9";
            return parent::selectall($_sql);
        }
        public function getAllTextLink(){
            $_sql="SELECT
                        weburl,
                        webname
                    FROM
                        cms_link
                    WHERE
                        state=1
                    AND
                        type=1
                   ";
            return parent::selectall($_sql);
        }
        
        public function getAllLogoLink(){
            $_sql="SELECT
                        weburl,
                        webname,
                        logourl
                    FROM
                        cms_link
                    WHERE
                        state=1
                    AND
                        type=2
                   ";
            return parent::selectall($_sql);
        }
    }
?>
