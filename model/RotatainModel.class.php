<?php

    //轮播实体类
    class RotatainModel extends Model{
        private $id;
        private $title;
        private $thumbnail;
        private $link;
        private $info;
        private $_limit;
        //拦截器get set
        public function __set($_key,$_value){
            $this->$_key=Tool::mysqlString($_value);
        }
        public function __get($_key){
            return $this->$_key;
        }
        public function getRotatainTotal(){
            $_sql="SELECT COUNT(*) FROM cms_rotatain";
            return parent::total($_sql);
        }
        //
        public function getFiveRotatain(){
            $_sql="SELECT
                            id,
                            title,
                            thumbnail,
                            link
                        FROM
                            cms_rotatain
                        WHERE 
                            state=1
                        ORDER BY
                            date DESC
                         LIMIT 0,".RO_NUM;
            return parent::selectall($_sql);
        }
        public function getAllRotatain(){
            
            $_sql="SELECT
                id,
                title,
                link linkall,
                link,
                state,
                state ok
            FROM
            cms_rotatain
            ORDER BY
                state DESC,
                date DESC
            $this->_limit ";
            return parent::selectall($_sql);
        }
        public function getSetRotatainTotal(){
            $_sql="SELECT COUNT(*) FROM cms_rotatain WHERE state=1";
            return parent::total($_sql);
        }
        public function getRotatain(){
            $_sql="SELECT  
                            id,
                            title,
                            thumbnail,
                            info,
                            link 
                        FROM 
                            cms_rotatain 
                        WHERE 
                            id='$this->id' 
                        LIMIT 
                            1";
            return parent::one($_sql);
        }
        //更新一个
        public function updateRotatain(){
            $_sql="UPDATE 
                        cms_rotatain 
                    SET 
                        title='$this->title',
                        thumbnail='$this->thumbnail',
                        link='$this->link',
                        info='$this->info'
                    WHERE 
                        id='$this->id'
                    LIMIT 1
                    ";
            return parent::aud($_sql);
        }
        //新增
        public function addRotatain(){
            
            $_sql="INSERT INTO
            cms_rotatain
            (
                title,
                thumbnail,
                link,
                info,
                date
            )
            VALUES
            (
            
                '$this->title',
                '$this->thumbnail',
                '$this->link',
                '$this->info',
                NOW()
            )";
            return parent::aud($_sql);
        }
        public function setStateOk(){
            $_sql="UPDATE
            cms_rotatain
            SET
            state=1
            WHERE
            id IN ($this->id)
            ";
            return parent::aud($_sql);
        }
        public function setStateNotOk(){
            $_sql="UPDATE
            cms_rotatain
            SET
            state=0
            WHERE
            id IN ($this->id)
            ";
            return parent::aud($_sql);
        }
        public function getOneRotatain(){
            $_sql="SELECT id FROM cms_rotatain WHERE id='$this->id' LIMIT 1";
            return  parent::one($_sql);
        }
        public function deleteRotatain(){
            $_sql="DELETE  FROM cms_rotatain WHERE id='$this->id' ";
            return parent::aud($_sql);
        }
    }
?>
