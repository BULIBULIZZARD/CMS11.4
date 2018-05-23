<?php

// 等级实体类
class AdverModel extends Model
{

    private $id;

    private $type;

    private $link;

    private $title;

    private $state;

    private $thumbnail;

    private $info;

    private $_limit;
    
    private $kind;

    // 拦截器get set
    public function __set($_key, $_value)
    {
        $this->$_key = Tool::mysqlString($_value);
    }

    public function __get($_key)
    {
        return $this->$_key;
    }

    public function getAdverTotal()
    {
        $_sql = "SELECT COUNT(*) FROM cms_adver WHERE type IN ($this->kind)";
        return parent::total($_sql);
    }
    //获取文字广告
    public function  getNewTextAdver(){
        
        $_sql="SELECT 
                    link,
                    title 
                FROM 
                    cms_adver 
                WHERE 
                    state=1
                AND 
                    type=1 
                ORDER BY 
                    date 
                LIMIT 0,".ADVER_TEXT_NUM;
        return parent::selectall($_sql);
    }
    
    //获取文字广告
    public function  getNewHeaderAdver(){
        
        $_sql="SELECT
                    link,
                    title,
                    thumbnail
                FROM
                    cms_adver
                WHERE
                    state=1
                AND
                    type=2
                ORDER BY
                    date
                LIMIT 0,".ADVER_PIC_NUM;
        return parent::selectall($_sql);
    }
    //获取文字广告
    public function  getNewSidebarAdver(){
        $_sql="SELECT
                    link,
                    title,
                    thumbnail
                FROM
                    cms_adver
                WHERE
                    state=1
                AND
                    type=3
                ORDER BY
                    date
                LIMIT 0,".ADVER_PIC_NUM;
        return parent::selectall($_sql);
    }
    public function getAllAdver(){
        
        $_sql="SELECT
                    id,
                    title,
                    link,
                    link linkall,
                    type,
                    type tp,
                    state,
                    state ok
                FROM
                    cms_adver
                WHERE
                    type IN ($this->kind)
                ORDER BY
                    state DESC,
                    date DESC
                    $this->_limit ";
        
        return parent::selectall($_sql);
    }
    public function getOneAdver(){
        $_sql="SELECT id FROM cms_adver WHERE id='$this->id' LIMIT 1";
        return  parent::one($_sql);
    }
    public function deleteAdver(){
        $_sql="DELETE  FROM cms_adver WHERE id='$this->id' ";
        return parent::aud($_sql);
    }
    public function setStateOk(){
        $_sql="UPDATE
        cms_adver
        SET
        state=1
        WHERE
        id IN ($this->id)
        ";
        return parent::aud($_sql);
    }
    public function setStateNotOk(){
        $_sql="UPDATE
        cms_adver
        SET
        state=0
        WHERE
        id IN ($this->id)
        ";
        return parent::aud($_sql);
    }
    public function addAdver()
    {
        $_sql = "INSERT INTO 
                            cms_adver
                            (
                                title,
                                link,
                                thumbnail,
                                info,
                                type,
                                state,
                                date
                            )
                            VALUES
                            (
                                '$this->title',
                                '$this->link',
                                '$this->thumbnail',
                                '$this->info',
                                '$this->type',
                                1,
                                NOW()
                            )";
        return parent::aud($_sql);
    }
    public function updateAdver(){
        $_sql="UPDATE 
                    cms_adver 
                SET 
                    title='$this->title',
                    link='$this->link',
                    thumbnail='$this->thumbnail',
                    info='$this->info',
                    type='$this->type'
                WHERE
                    id='$this->id'
                LIMIT 1
                ";
        return parent::aud($_sql);
    }
    public function getAdver(){
        $_sql="SELECT 
                     id,
                     title,
                     link,
                     thumbnail,
                     info,
                     type
                   FROM 
                     cms_adver
                  WHERE 
                     id='$this->id'
                          ";
        return parent::one($_sql);
    }
}
?>
