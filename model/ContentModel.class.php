<?php

// 等级实体类
class ContentModel extends Model
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
    private $sort;
    private $readlimit;
    private $search;
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
    //keyword搜索文章总数
    public function searchKeywordTotal(){
        $_sql="SELECT COUNT(*) FROM
                                    cms_content c,
                                    cms_nav v
                                WHERE
                                    c.keyword LIKE '%$this->search%'
                                AND
        c.nav=v.id;";
        return parent::total($_sql);
    }
    //keyword搜索文章
    public function searchKeywordContent(){
        $_sql="SELECT
        c.id,
        c.title,
        c.title  t,
        c.date,
        c.attr,
        c.gold,
        c.keyword,
        c.info,
        c.thumbnail,
        c.count,
        c.nav,
        v.nav_name
        FROM
        cms_content c,
        cms_nav v
        WHERE
        c.nav=v.id
        AND
        c.keyword LIKE '%$this->search%'
        ORDER BY c.date DESC
        $this->_limit
        " ;
        return parent::selectall($_sql);
    }
    //搜索tag总数
    public function searchTagTotal(){
        $_sql="SELECT COUNT(*) FROM
        cms_content c,
        cms_nav v
        WHERE
        c.tag LIKE '%$this->search%'
        AND
        c.nav=v.id;";
        return parent::total($_sql);
    }
    //搜索tag文章列表
    public function searchTagContent(){
        $_sql="SELECT
        c.id,
        c.title,
        c.title  t,
        c.date,
        c.attr,
        c.gold,
        c.keyword,
        c.info,
        c.thumbnail,
        c.count,
        c.nav,
        v.nav_name
        FROM
        cms_content c,
        cms_nav v
        WHERE
        c.nav=v.id
        AND
        c.tag LIKE '%$this->search%'
        ORDER BY c.date DESC
        $this->_limit
        " ;
        return parent::selectall($_sql);
    }
    
    //标题搜索文章总数
    public function searchTitleTotal(){
        $_sql="SELECT COUNT(*) FROM
                            cms_content c,
                            cms_nav v
                        WHERE
                            c.title LIKE '%$this->search%'
                        AND
                            c.nav=v.id;";
        return parent::total($_sql);
    }
    //标题搜索文章列表
    public function searchTitleContent(){
        $_sql="SELECT
                    c.id,
                    c.title,
                    c.title  t,
                    c.date,
                    c.attr,
                    c.gold,
                    c.keyword,
                    c.info,
                    c.thumbnail,
                    c.count,
                    c.nav,
                    v.nav_name
                FROM
                    cms_content c,
                    cms_nav v
                WHERE
                    c.nav=v.id
                AND 
                    c.title LIKE '%$this->search%'
                ORDER BY c.date DESC
                    $this->_limit
                    " ;
        return parent::selectall($_sql);
    }
    
    
    //最新七条推荐文档
    public function getNewRecList(){
        $_sql="SELECT 
                    id,
                    title,
                    date 
                FROM 
                    cms_content 
                WHERE 
                    attr 
                LIKE 
                    '%推荐%' 
                ORDER BY 
                    date 
                DESC
                LIMIT 
                    0,7";
        return parent::selectall($_sql);
    }
    //累计阅读量
    public function setContentCount(){
        $_sql="UPDATE cms_content SET count=count+1 WHERE id='$this->id' LIMIT 1";
        return parent::aud($_sql);
    }
    //获取本月热点7tia
    public function getMonthHot(){
        $_sql="SELECT 
                    id,
                    title,
                    date
                FROM 
                    cms_content 
                WHERE 
                    MONTH(NOW())=DATE_FORMAT(date,'%c') 
                ORDER BY 
                    count 
                DESC 
                LIMIT 
                    0,7";
        return parent::selectall($_sql);
    }
    //最新四条图文资讯
    public function getPicList(){
        $_sql="SELECT 
                        id,
                        title,
                        thumbnail 
                    FROM  
                        cms_content 
                    WHERE 
                        thumbnail<>'' 
                    ORDER BY 
                        date 
                    DESC
                    LIMIT 
                        0,4";
        return parent::selectall($_sql);
    }
    //本月评论数top7
    public function getMonthCommentList(){
        $_sql="SELECT
            ct.id,
            ct.title,
            ct.date
        FROM
            cms_content ct
        WHERE
            MONTH(NOW())=DATE_FORMAT(ct.date,'%c')
        ORDER BY
            (SELECT COUNT(*) FROM cms_comment c WHERE c.cid=ct.id)
        DESC
        LIMIT
            0,7";
        return parent::selectall($_sql);
    }
    //获取最新头条
    public function getNewTop(){
        $_sql="SELECT 
                    id,
                    title,
                    info 
                FROM 
                    cms_content 
                WHERE 
                    attr 
                LIKE 
                    '%头条%' 
                ORDER BY 
                    date 
                DESC LIMIT 0,1";
        return parent::one($_sql);
    }
    //获取最新2,5个头条
    public function getNewTopList(){
        $_sql="SELECT
                    id,
                    title,
                    info
                FROM
                    cms_content
                WHERE
                    attr
                LIKE
                    '%头条%'
                ORDER BY
                    date
                DESC LIMIT 1,4";
        return parent::selectall($_sql);
    }
    //获取一个栏目的11条最新
    public function getNewNavList(){
        $_sql="SELECT 
                        id,
                        title,
                        date 
                    FROM 
                        cms_content 
                    WHERE 
                        nav IN (SELECT id FROM cms_nav WHERE pid='$this->nav')
                    ORDER BY
                        date  
                    DESC
                    LIMIT 
                        0,11
";
        return parent::selectall($_sql);
    }
    //最新十条
    public function getNewList(){
        $_sql="SELECT 
                    id,
                    title,
                    date,
                    info 
                FROM 
                    cms_content 
                ORDER BY 
                    date
                DESC 
                LIMIT 
                    0,10";
        return parent::selectall($_sql);
    }
    //文档列表
    public function getListContent(){
        $_sql="SELECT 
                        c.id,
                        c.title,
                        c.title as t,
                        c.date,
                        c.attr,
                        c.gold,
                        c.keyword,
                        c.info,
                        c.thumbnail,
                        c.count,
                        c.nav,
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
    //当月推荐 top10
    public function getSearchMonthRec(){
        $_sql="SELECT
        id,
        title,
        date
        FROM
        cms_content
        WHERE
        attr LIKE '%推荐%'
        AND
        MONTH(NOW())=DATE_FORMAT(date,'%c')
        ORDER BY
        date
        DESC
        LIMIT
        0,10";
        return parent::selectall($_sql);
    }
    //本类当月推荐 top10
    public function getMonthNavRec(){
        $_sql="SELECT 
                    id,
                    title,
                    date
                FROM 
                    cms_content 
                WHERE
                    attr LIKE '%推荐%'
                AND
                    MONTH(NOW())=DATE_FORMAT(date,'%c')
                AND
                    nav IN ($this->nav)
                ORDER BY 
                    date 
                DESC
                LIMIT 
                    0,10";
        return parent::selectall($_sql);
    }
    //当月热点 top10
    public function getSearchMonthHot(){
        $_sql="SELECT
        ct.id,
        ct.title,
        ct.date
        FROM
        cms_content ct
        WHERE
        MONTH(NOW())=DATE_FORMAT(ct.date,'%c')
        ORDER BY
        (SELECT COUNT(*) FROM cms_comment c WHERE c.cid=ct.id AND c.state=1)
        DESC
        LIMIT
        0,10";
        return parent::selectall($_sql);
    }
    //本类当月热点 top10
    public function getMonthNavHot(){
        $_sql="SELECT
            ct.id,
            ct.title,
            ct.date
        FROM
            cms_content ct
        WHERE
            MONTH(NOW())=DATE_FORMAT(ct.date,'%c')
        AND
            ct.nav IN ($this->nav)
        ORDER BY
            (SELECT COUNT(*) FROM cms_comment c WHERE c.cid=ct.id AND c.state=1)
        DESC
        LIMIT
            0,10";
        return parent::selectall($_sql);
    }
    //当月图文top10
    public function getSearchMonthPic(){
        $_sql="SELECT
        id,
        title,
        date
        FROM
        cms_content
        WHERE
        thumbnail<>''
        AND
        MONTH(NOW())=DATE_FORMAT(date,'%c')
        ORDER BY
        date
        DESC
        LIMIT
        0,10";
        return parent::selectall($_sql);
    }
    //本类当月图文top10
    public function getMonthNavPic(){
        $_sql="SELECT
            id,
            title,
            date
        FROM
            cms_content
        WHERE
            thumbnail<>''
        AND
            MONTH(NOW())=DATE_FORMAT(date,'%c')
        AND
            nav IN ($this->nav)
        ORDER BY
            date
        DESC
        LIMIT
            0,10";
        return parent::selectall($_sql);
    }
    //文章评论从大到小sort
    public function getMostCommentContent(){
        $_sql="SELECT
                        ct.id,
                        ct.title
                FROM
                        cms_content ct
                ORDER BY
                        (SELECT COUNT(*) FROM cms_comment c WHERE c.cid=ct.id AND c.state=1)
                DESC
                        LIMIT 0,20";
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
    
   
    //details contnet
    public function getOneContent(){
        $_sql="SELECT 
                        id,
                        title,
                        content,
                        info,
                        date,
                        count,
                        tag,
                        keyword,
                        thumbnail,
                        attr,
                        author,
                        gold,
                        source,
                        color,
                        sort,
                        commend,
                        readlimit,
                        nav
                   FROM 
                        cms_content 
                   WHERE 
                        id='$this->id'";
        return parent::one($_sql);
    }
    
    public function updateContent(){
        $_sql="UPDATE 
                                cms_content 
                        SET 
                                title='$this->title',
                                nav='$this->nav',
                                attr='$this->attr',
                                tag='$this->tag',
                                keyword='$this->keyword',
                                thumbnail='$this->thumbnail',
                                info='$this->info',
                                source='$this->source',
                                author='$this->author',
                                content='$this->content',
                                commend='$this->commend',
                                count='$this->count',
                                gold='$this->gold',
                                color='$this->color',
                                sort='$this->sort',
                                readlimit='$this->readlimit'
                         WHERE 
                                id='$this->id'";
        return parent::aud($_sql);
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
                sort,
                readlimit,
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
                '$this->sort',
                '$this->readlimit',
                NOW()
             )";
        return parent::aud($_sql);
    }
    //栓出
    public function deleteContent(){
        
        $_sql="DELETE FROM cms_content WHERE id='$this->id' LIMIT 1";
        return parent::aud($_sql);
    }
    
}
?>
