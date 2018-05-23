<?php
//局部动态
class Cache{
    
    
    public function details(){
        $_content=new ContentModel();
        $_content->id=$_GET['id'];
        $this->setContentCount($_content);
        $this->getContentCount($_content);
    }
    public function _action(){
        switch ($_GET['type']){
            case 'details':
                $this->details();
                break;
            case 'header':
                $this->header();
                break;
            case 'index':
                $this->index();
                break;
            default:
                Tool::alertBack('ERROR:WRONG_TYPE');
        }
    }
    private function index(){
        $_cookie=new Cookie('user');
        $_user=$_cookie->getCookie();
        $_facecookie=new Cookie('face');
        $_face=$_facecookie->getCookie();
        if(!($_user&&$_face)){
            $member.='<h2>会员登陆</h2>';
            $member.='<form method="post" name="login" action="register.php?action=login">';	
            $member.='<label>用户名:<input type="text" name="user" class="text"></label>';	
            $member.='<label>密　码:<input type="password" name="pass" class="text"></label>';	
            $member.='<label class="yzm">验证码:<input type="text" name="code" class="text code"> <img src="config/code.php" onclick=javascript:this.src="config/code.php?tm="+Math.random(); class="code"></label>';	
            $member.='<p><input type="submit" name="send" value="登陆" class="submit" onclick="return checkLogin();">  <a href="register.php?action=reg">注册会员</a>  <a href="###">忘记密码?</a></p>';	
            $member.='</form>';	
        }else 
        {
            $member.='<h2>会员信息</h2>';
            $member.='<div class="a">';
            $member.='您好,<strong>'.Tool::subStr($_user, null,8, 'utf-8').'</strong>';
            $member.='</div>';
            $member.='<div class="b">';
            $member.='<img src="images/face/'.$_face.'"';
            $member.='alt="{$user}">';
            $member.='<a href="###">个人中心</a>';
            $member.='<a href="###">我的评论</a>';
            $member.='<a href="register.php?action=logout">退出登陆</a>';
            $member.='</div>';
        }
        echo "
        function getIndexLogin(){document.write('$member');}
        ";
    }
    private function setContentCount(&$_content){
        $_content->setContentCount();
    }
    
    private function getContentCount(&$_content){
        $_count=$_content->getOneContent()->count;
        echo "
        function getContentCount(){document.write('$_count');}
        ";
    }
    private function header(){
        $_cookie=new Cookie('user');
        if($_cookie->getCookie()){
            echo "
            function getHeader(){document.write('<a class=\"user\">{$_cookie->getCookie()}______</a><a href=\"register.php?action=logout\" class=\"user\">退出</a> ');}
            ";
        }else {
            echo "
            function getHeader(){document.write('<a href=\"register.php?action=reg\" class=\"user\">注册</a> <a href=\"register.php?action=login\" class=\"user\">登陆</a> ');}
            ";            
       }
    }
}
?>