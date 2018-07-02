<?php

// 投票实体类
class TagModel extends Model
{

    private $id;

    private $name;

    private $count;

    // 拦截器get set
    public function __set($_key, $_value)
    {
        $this->$_key = Tool::mysqlString($_value);
    }

    public function __get($_key)
    {
        return $this->$_key;
    }

    public function addTag()
    {
        $_sql = "INSERT INTO cms_tag(name) VALUES ('$this->name')";
        return parent::aud($_sql);
    }

    public function checkTag()
    {
        $_sql = "SELECT id FROM cms_tag WHERE name='$this->name'LIMIT 1";
        return parent::one($_sql);
    }
    
    public function countTag(){
        $_sql = "UPDATE cms_tag SET count=count+1 WHERE name='$this->name' LIMIT 1";
        return parent::aud($_sql);
    }
    
    //获取五个点击最多Tag
    public function getFiveTag(){
        $_sql="SELECT name,count FROM cms_tag ORDER BY count DESC";
        return parent::selectall($_sql);
    }
    
    
    
    
    
    
    
}
?>
