<?php
    //上传类 
    class FileUpload{
        private $error;
        private $maxsize;
        private $type;
        private $typeArr=array('image/jpeg','image/pjpeg','image/x-png','image/png','image/gif');
        private $path;
        private $today;
        private $name;              //文件原名
        private $tmp;
        private $linkpath;  
        private $linkdate;
        //链接路径
        //构造 
        public function __construct($_file,$_maxsize){
            $this->error=$_FILES[$_file]['error'];
            $this->maxsize=$_maxsize/1024;
            $this->type=$_FILES[$_file]['type'];
            $this->path=ROOT_PATH.UPDIR;
            $this->name=$_FILES[$_file]['name'];
            $this->linkdate=date('Ymd').'/';
            $this->today=$this->path.$this->linkdate;
            $this->tmp=$_FILES[$_file]['tmp_name'];
            $this->checkError();
            $this->checkType();
            $this->checkPath();
            $this->moveUpload();
        }
        //返回路径
        public function getPath(){
            $_path=$_SERVER["SCRIPT_NAME"];
            $_dir=dirname(dirname($_path));
            $this->linkpath=$_dir.$this->linkpath;
            return $this->linkpath;
        }
        //移动临时文件
        private function moveUpload(){
            if(!is_uploaded_file($this->tmp))Tool::alertBack('ERROR---临时文件不存在');
            if(!move_uploaded_file($this->tmp, $this->setNewName()))Tool::alertBack('ERROR---移动文件失败');
        }
        //设置新文件名
        private function setNewName(){
            $_nameArr=explode('.',$this->name);
            $_postfix= $_nameArr[count($_nameArr)-1];
            $_newname=date('YmdHis').mt_rand(100,1000).'.'.$_postfix;
            $this->linkpath=UPDIR.$this->linkdate.$_newname;
            return $this->today.$_newname;
            
        }
        //验证目录
        private function checkPath(){
            if(!is_dir($this->path)||!is_writeable($this->path)){
                if(!mkdir($this->path))Tool::alertBack('ERROR---上传目录创建失败');
            }
            if(!is_dir($this->today)||!is_writeable($this->today)){
                if(!mkdir($this->today))Tool::alertBack('ERROR---当前上传目录创建失败');
            }
        }
        //验证类型
        private function checkType(){
            if (!in_array($this->type, $this->typeArr))Tool::alertBack("ERROR---规定外的上传类型$this->type");
        }
        //验证错误 
        private function checkError(){
            if(!empty($this->error)){
                switch ($this->error){
                    case 1:
                        Tool::alertBack('ERROR---上传文件超过约定值');
                        break;
                    case 2:
                        Tool::alertBack('ERROR---上传文件超过表单最大值('.$this->maxsize.'KB)');
                        break;
                    case 3:
                        Tool::alertBack('ERROR---文件只有部分被上传');
                        break;
                    case 4:
                        Tool::alertBack('ERROR---没有文件被上传');
                        break;
                    default:
                        Tool::alertBack('UNKNOW UPLOAD ERROR');
                }
            }
        }
    }
   
    

?>