<?php

// 会员实体类
class UserModel extends Model
{
    private $id;
    private $user;
    private $pass;
    private $email;
    private $question;
    private $answer;
    private $state;
    private $date;
    private $face;
    private $time;
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
    //
    public function getAllUser()
    {
        $_sql="SELECT   id,
                        user,
                        email,
                        state
                        FROM 
                        cms_user 
                    ORDER BY  
                        date 
                     DESC 
                      $this->_limit ";
        return parent::selectall($_sql);
    }  
    public function getUserTotal(){
        $_sql="SELECT COUNT(*) FROM cms_user";
        return parent::total($_sql);
    }
    //用户名重复验证
    public function checkUser(){
        $_sql="SELECT id FROM cms_user WHERE user='$this->user' LIMIT 1";
        return parent::aud($_sql);
    }
    //email 重复验证
    public function checkEmail(){
        $_sql="SELECT id FROM cms_user WHERE email='$this->email' LIMIT 1";
        return parent::aud($_sql);
    }
    //更新登陆时间戳
    public function setLater(){
        $_sql="UPDATE cms_user SET time='$this->time' WHERE user='$this->user' LIMIT 1"; 
        return parent::aud($_sql);
    }
    public function getLaterUser(){
        $_sql="SELECT user,face FROM cms_user ORDER BY time DESC LIMIT 0,6";
        return parent::selectall($_sql);
    }
    public function checkLogin(){
        $_sql="SELECT user,face FROM cms_user WHERE user='$this->user' AND pass='$this->pass' LIMIT 1";
        return parent::one($_sql);
    }
    public function deleteUser(){
        $_sql="DELETE FROM cms_user WHERE id='$this->id' LIMIT 1";
        return parent::aud($_sql);
    }
    public function updateUser(){
        $_sql="UPDATE 
                        cms_user 
                    SET 
                        pass='$this->pass',
                        email='$this->email',
                        face='$this->face',
                        question='$this->question',
                        answer='$this->answer',
                        state='$this->state' 
                    WHERE
                        id='$this->id'
                    LIMIT 
                        1
";
        return parent::aud($_sql);
    }
    public function getOneUser(){
        $_sql="SELECT
                        user,
                        pass,
                        email,
                        face,
                        question,
                        answer,
                        state 
                    FROM 
                        cms_user 
                    WHERE 
                        id='$this->id' 
                    LIMIT 
                        1";
        return parent::one($_sql);
    }
    public function addUser()
    {
        $_sql = "INSERT INTO 
                            cms_user
                                (user,
                                pass,
                                email,
                                face,
                                question,
                                answer,
                                state,
                                date)
                            VALUES
                                ('$this->user',
                                '$this->pass',
                                '$this->email',
                                '$this->face',
                                '$this->question',
                                '$this->answer',
                                '$this->state',
                                NOW())";
        return parent::aud($_sql);
    }
}
?>
