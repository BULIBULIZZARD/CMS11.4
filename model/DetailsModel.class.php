<?php

// 等级实体类
class DetailsModel extends Model
{

    private $title;
    private $nav;
    private $attr;
    private $tag;
    private $keyword;
    private $thumbnail;
    private $info;
    private $source;
    private $author;
    private $content;
    private $commend;
    private $count;
    private $gold;
    private $color;
    private $_limit;
    
    //拦截器get set public 
    // 拦截器get set
    function __set($_key, $_value)
    {
        $this->$_key = Tool::mysqlString($_value);
    }

    public function __get($_key)
    {
        return $this->$_key;
    }

    //获取子类id
    public function getNavChildId(){
        $_sql="SELECT id FROM cms_nav WHERE pid='$this->nav'";
        return parent::selectall($_sql);
    }
    //文档列表
    public function getListContent(){
        $_sql="SELECT 
                        c.id,
                        c.title,
                        c.date,
                        c.info,
                        c.thumbnail,
                        c.count,
                        v.nav_name
                FROM 
                        cms_content c,
                        cms_nav v
                WHERE 
                        nav in($this->nav)
                 AND
                        c.nav=v.id
                  ORDER BY c.date DESC
        $this->_limit
       " ;
        return parent::selectall($_sql);
    }
    
    public function getListContentTotal(){
        $_sql="SELECT COUNT(*) FROM 
                        cms_content c,
                        cms_nav v
                WHERE 
                        nav in($this->nav)
                 AND
                        c.nav=v.id;";
        return parent::total($_sql);
    }
    // 新增文档
    public function addContent()
    {
        $_sql = "INSERT INTO
            cms_content
            (
                title,
                nav,
                attr,
                tag,
                keyword,
                thumbnail,
                info,
                source,
                author,
                content,
                commend,
                count,
                gold,
                color,
                date
                
            )
            VALUES
            (
                '$this->title',
                '$this->nav',
                '$this->attr',
                '$this->tag',
                '$this->keyword',
                '$this->thumbnail',
                '$this->info',
                '$this->source',
                '$this->author',
                '$this->content',
                '$this->commend',
                '$this->count',
                '$this->gold',
                '$this->color',
                NOW()
             )";
        return parent::aud($_sql);
    }
}
?>
