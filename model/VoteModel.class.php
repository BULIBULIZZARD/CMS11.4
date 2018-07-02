<?php

    //投票实体类
    class VoteModel extends Model{
        private $id;
        private $date;
        private $state;
        private $title;
        private $info;
        private $vid=0;
        private $count;
        private $_limit;
        
        
        //拦截器get set
        public function __set($_key,$_value){
            $this->$_key=Tool::mysqlString($_value);
        }
        public function __get($_key){
            return $this->$_key;
        }
        public function getVoteTotal(){
            $_sql="SELECT COUNT(*) FROM cms_vote WHERE vid=0 ";
            return parent::total($_sql);
        }
        public function getVoteChildTotal(){
            $_sql="SELECT COUNT(*) FROM cms_vote WHERE vid='$this->vid'";
            return parent::total($_sql);
        }
        
        //获取显示主题
        public function  getShowVoteTitle(){
            $_sql="SELECT title FROM cms_vote WHERE state=1 LIMIT 1";
            return parent::one($_sql);
        }
        //累计投票
        public function setCount(){
            $_sql="UPDATE 
                            cms_vote 
                        SET 
                            count=count+1 
                        WHERE 
                            id='$this->id'";
            return parent::aud($_sql);
        }
        // 获取总票数 
        public function getVoteSum(){
            $_sql="SELECT 
                                SUM(count)  c
                            FROM 
                                cms_vote
                            WHERE 
                                vid=(
                                    SELECT 
                                        id 
                                    FROM 
                                        cms_vote 
                                    WHERE 
                                        state=1 
                                    LIMIT 1)";
            return parent::one($_sql);
        }
        public function getShowChild(){
            $_sql="SELECT 
                            id,
                            title,
                            count 
                        FROM 
                            cms_vote 
                        WHERE 
                            vid=(
                                    SELECT 
                                        id 
                                    FROM 
                                        cms_vote 
                                    WHERE 
                                        state=1 
                                    LIMIT 1)";
            return parent::selectall($_sql);
        }
        //查询
        public function getAllVote(){
            $_sql="SELECT
                          c.id,
                          c.title,
                          c.state,
                            (SELECT 
                            SUM(count) 
                            FROM 
                            cms_vote v 
                            WHERE 
                            v.vid=c.id) 
                            pcount
                   FROM
                          cms_vote c
                   WHERE
                          c.vid=0
                   ORDER BY
                          state DESC,
                          date DESC
                       $this->_limit";
            return parent::selectall($_sql);
        }
        
        //查询
        public function getAllChildVote(){
            $_sql="SELECT
                        id,
                        title,
                        state,
                        count
                    FROM
                        cms_vote
                    WHERE
                        vid='$this->vid'
                    ORDER BY
                        state DESC,
                        date DESC
                    $this->_limit";
            return parent::selectall($_sql);
        }
        public function getOneTitle(){
            $_sql="SELECT 
                            id,
                            title,
                            vid,
                            info 
                        FROM 
                            cms_vote 
                        WHERE 
                            id=$this->id
                        LIMIT 1";
            return parent::one($_sql);
        }
        public function updateVote(){
            $_sql="UPDATE 
                            cms_vote 
                        SET 
                            title='$this->title',
                            info='$this->info'
                        WHERE
                            id='$this->id'
                        LIMIT 1";
            return parent::aud($_sql);
        }
        public function setState(){
            $_sql="UPDATE
                            cms_vote
                          SET
                            state=1
                          WHERE
                            id='$this->id'
                          LIMIT 1  
                            ";
            return parent::aud($_sql);
        }
        public function setStateNotOk(){
            $_sql="UPDATE
                        cms_vote
                    SET
                        state=0
                    WHERE
                        state=1
                    LIMIT 1
            ";
            return parent::aud($_sql);
        }
        //新增
        public function addVote(){
            $_sql="INSERT INTO
            cms_vote
            (
                title,
                info,
                vid,
                date
            )
            VALUES
            (
                '$this->title',
                '$this->info',
                '$this->vid',
                NOW()
            )";
            return parent::aud($_sql);
        }
        public function deleteVote(){
            $_sql="DELETE FROM 
                                cms_vote 
                            WHERE 
                                id='$this->id' 
                            OR 
                                vid='$this->id'
                            ";
            return parent::aud($_sql);
        }
    }
?>
