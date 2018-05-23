<?php

//  评论实体类
class CommentModel extends Model
{   
    private $id;
    private $user;
    private $cid;
    private $content;
    private $manner;
    private $_limit;
    
    // 拦截器get set
    public function __set($_key, $_value)
    {
        $this->$_key = Tool::mysqlString($_value);
    }
    public function __get($_key)
    {
        return $this->$_key;
    }
    
    public function deleteComment(){
        $_sql="DELETE  FROM cms_comment WHERE id='$this->id' ";
        return parent::aud($_sql);
    }
    //获取最新三个评论
    public function getNewThreeComment(){
        $_sql="SELECT
            c.id,
            c.cid,
            c.user,
            c.manner,
            c.content,
            c.date,
            c.oppose,
            c.sustain,
            u.face
        FROM
            cms_comment c
        LEFT JOIN
            cms_user u
        ON
            c.user=u.user
        WHERE
            cid='$this->cid'
        AND 
            c.state=1
        ORDER BY
            date
            DESC
        LIMIT 0,3
        ";
        return parent::selectall($_sql);
    }
    public function getHotComment(){
        $_sql="SELECT
                c.id,
                c.cid,
                c.user,
                c.manner,
                c.content,
                c.date,
                c.oppose,
                c.sustain,
                u.face
        FROM
             cms_comment c
        LEFT JOIN
            cms_user u
        ON
            c.user=u.user
        WHERE
            cid='$this->cid'
        AND
            c.state=1
        AND 
            (c.sustain-c.oppose) >0 
        ORDER BY
            (c.sustain-c.oppose) 
        DESC
            LIMIT 0,3
        ";
        return parent::selectall($_sql);
    }
    //拖过审核
    public function setStateOk(){
        $_sql="UPDATE 
                    cms_comment 
                SET 
                    state=1 
                WHERE 
                    id IN ($this->id) 
                ";
        return parent::aud($_sql);
    }
    //后台获得所有数据
    public function setStateNotOk(){
        $_sql="UPDATE 
                    cms_comment 
                SET 
                    state=0 
                WHERE 
                    id IN ($this->id) 
                ";
        return parent::aud($_sql);
    }
    public function getOneComment(){
       $_sql="SELECT id FROM cms_comment WHERE id='$this->id' LIMIT 1";
       return  parent::one($_sql);
    }
    public function getCommentList(){
       $_sql="SELECT 
                    c.id,
                    c.user,
                    c.content,
                    c.content full,
                    c.cid,
                    ct.title,
                    c.state,
                    c.state type
                FROM 
                    cms_comment c,
                    cms_content ct 
                WHERE 
                    c.cid=ct.id
                ORDER BY 
                    c.state 
                ASC ,
                    c.date 
                DESC 
                $this->_limit";
       return parent::selectall($_sql);
    }
    //select all by cid(前台)
    public function getAllComment(){
        $_sql="SELECT 
                        c.id,
                        c.cid,
                        c.user,
                        c.manner,
                        c.content,
                        c.date,
                        c.oppose,
                        c.sustain, 
                        u.face
                FROM 
                        cms_comment c
            LEFT JOIN   
                        cms_user u 
                   ON   
                        c.user=u.user
                WHERE 
                        cid='$this->cid' 
                AND
                        c.state=1
                ORDER BY
                        date 
                DESC
                $this->_limit;
                ";
        return parent::selectall($_sql);
    }

    // get total(后台)
    public function getCommentListTotal(){
        $_sql="SELECT  COUNT(*) FROM cms_comment ";
        return parent::total($_sql);
    }
    // get total(前台)
    public function getCommentTotal(){
        $_sql="SELECT  COUNT(*) FROM cms_comment where cid='$this->cid' AND state=1";
        return parent::total($_sql);
    }
    
    public function setSustain(){
        $_sql="UPDATE cms_comment SET sustain=sustain+1 WHERE id='$this->id' LIMIT 1";
        return parent::aud($_sql);
    }
    public function setOppose(){
        $_sql="UPDATE cms_comment SET oppose=oppose+1 WHERE id='$this->id' LIMIT 1";
        return parent::aud($_sql);
    }
    //add
    public function addComment(){
        $_sql="INSERT INTO 
                            cms_comment 
                            ( 
                                user,
                                manner,
                                content,
                                cid,
                                date
                            ) 
                            VALUE 
                            ( 
                                '$this->user',
                                '$this->manner',
                                '$this->content',
                                '$this->cid',
                                NOW()
                            )";
        return parent::aud($_sql);
        
    }
    
}
?>
