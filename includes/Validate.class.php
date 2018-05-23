<?php

    class Validate{
        
        //空
        static public function checkNull($_data){
            return (trim($_data)=='')?true:false;
        }
        
        //长度
        static public function checkLength($_data,$_length,$_flag){
            if ($_flag){
               return mb_strlen(trim($_data),'utf-8')<$_length?true:false;
            }else {
               return mb_strlen(trim($_data),'utf-8')>$_length?true:false;
            }
        }
        static function checkPremission($_num,$_premission)
        {
            if(!$_premission)return true;
            return in_array($_num,explode(',',$_premission))?false:true;
        }
        static function checkEmail($_data)
        {
            
            return preg_match('/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/', $_data)?false:true;
        }
        static public function checkNum($_data){
            return is_numeric(trim($_data))?false:true;
        }
        //一致
        static public function checkEquals($_data,$_redata){
            return trim($_data)!=trim($_redata)?true:false;
        }
        
        static public function checkLengthequal($_data,$_length){
            return mb_strlen(trim($_data),'utf-8')==$_length?true:false;
        }
        
        static public function checkSession(){
            if(!isset($_SESSION['admin']))Tool::alertBack('请登陆后重试');
        }
    }
?>