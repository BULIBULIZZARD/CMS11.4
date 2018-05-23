<?php

class Tool
{  
    //获取当天文件tpl名
    static public function tplName(){
        $_str=explode('/', $_SERVER["SCRIPT_NAME"]);
        $_str= explode('.',$_str[count($_str)-1]);
        return $_str[0];
    }
    //替换默认图片 
    static public function none($_object,$_field){
        foreach  ($_object as $_value){
            if(!$_value->$_field)$_value->$_field="images/none.jpg";
            //if(is_array(getimagesize($_value->$_field)))$_value->$_field="images/none.jpg";
            
        }
        return $_object;
    }
    //html显示
    static public function unHtml($_string){
        return htmlspecialchars_decode($_string);
    }
    //数组转换成逗号字符串( , , )
    static public function objArrOfStr($_object,$_field){
        if ($_field){
            foreach  ($_object as $_value){
                $_string.=$_value->$_field.',';
            }
        }else {
            foreach  ($_object as $_value){
                $_string.=$_value.',';
            }
        }
        return substr($_string,0,strlen($_string)-1);
    }
    //字符串截取
    static public function subStr($_object,$_field,$_leng,$_encoding){
        if ($_object){
            if (is_array($_object)){
                foreach ($_object as $_value){
                    if(mb_strlen($_value->$_field,$_encoding)>$_leng){
                        $_value->$_field=mb_substr($_value->$_field,0,$_leng,$_encoding).'...';
                    }
                }
            }else{
                if(mb_strlen($_object,$_encoding)>$_leng){
                    return $_object=mb_substr($_object,0,$_leng,$_encoding).'...';
                }
                return $_object;
            }
            
        }
    }
    // 弹窗转跳
    static public function alertLocation($_info, $_url)
    {
        if (! empty($_info)) {
            echo "<script type='text/javascript'>alert('$_info');location.href='$_url'</script>";
        }
        else {
            echo 'Location:'.$_url;
            header('Location:'.$_url);
        }
        exit();
    }
    //上传专用
    static public function alertOpenerClose($_info,$_path){
        echo "<script type='text/javascript'>alert('$_info');</script>";
        echo "<script type='text/javascript'>opener.document.content.thumbnail.value='$_path'</script>";
        echo "<script type='text/javascript'>opener.document.content.pic.style.display='block'</script>";
        echo "<script type='text/javascript'>opener.document.content.pic.src='$_path'</script>";
        echo "<script type='text/javascript'>window.close();</script>";
        exit();
    }
    // 弹窗返回
    static public function alertBack($_info)
    {
        echo "<script type='text/javascript'>alert('$_info');history.back()</script>";
        exit();
    }
    static public function alertClose($_info)
    {
        echo "<script type='text/javascript'>alert('$_info');close();</script>";
        exit();
    }
    static public function unSession(){
        if(session_start()){
            session_destroy();
        }
    }
    
    static public function htmlString($_date){
        ini_set( 'display_errors', 'off' );
        if (is_array($_date)){
            foreach ($_date as $_key=>$_value){
                $_string[$_key]=Tool::htmlString($_value); 
            }
        }else if(is_object($_date)){
            foreach ($_date as $_key=>$_value){
                $_string->$_key=Tool::htmlString($_value);
            }
        }else {
            $_string=htmlspecialchars($_date);
        }
        return $_string;
    }
    static public function mysqlString($_date){
        if(!GPC){
            $_mysqli=DB::getDB(); 
            return $_mysqli->real_escape_string($_date);
            DB::unDB($_result=null, $_mysqli);
        }
        else{
            return $_date;
        }
    }
    // 日期转换
    static public function objDate(&$_object,$_field){
        if($_object){
            foreach ($_object as $_value){
                $_value->$_field= date('m-d',strtotime($_value->$_field));
            }
        }
    }
    
    
    
    
    
    
    
    
    
    
    
}
?>