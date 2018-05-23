<?php

// 图像处理类
class Image
{

    private $file;

    private $width;

    private $height;

    private $type;

    private $img;

    private $new;

    public function __construct($_file)
    {
        $this->file = $_SERVER["DOCUMENT_ROOT"] . $_file;
        list ($this->width, $this->height, $this->type) = getimagesize($this->file);
        $this->img = $this->getFromImg($this->file, $this->type);
    }

    // 百分比缩略
    // private function thumb($_per)
    // {
    // $new_width = $this->width * ($_per / 100);
    // $new_height = $this->height * ($_per / 100);
    // $this->new = imagecreatetruecolor($new_width, $new_height);
    // imagecopyresampled($this->new, $this->img, 0, 0, 0, 0, $new_width, $new_height, $this->width, $this->width);
    // }
    
    // 等比例缩略
    // public function thumb($new_width, $new_height)
    // {
    // if ($this->width < $this->height) {
    // $new_width = ($new_height / $this->height) * $this->width;
    // } else {
    // $new_height = ($new_width / $this->width) * $this->height;
    // }
    // $this->new = imagecreatetruecolor($new_width, $new_height);
    // imagecopyresampled($this->new, $this->img, 0, 0, 0, 0, $new_width, $new_height, $this->width, $this->width);
    // }
    public function ckeImg($new_width = 0, $new_height = 0)
    {
        list ($_mark_width, $_mark_height, $_mark_type) = getimagesize($this->file);
        $_mark = $this->getFromImg(MARK, $_mark_type);
        if (empty($new_width) || empty($new_height)) {
            $new_width = $this->width;
            $new_height = $this->height;
        }
        if (! is_numeric($new_width) || ! is_numeric($new_height)) {
            $new_width = $this->width;
            $new_height = $this->height;
        }
        if ($this->height > $new_height) {
            $new_width = ($new_height / $this->height) * $this->width;
        } 
        if($this->width > $new_width)
        {
            $new_height = ($new_width / $this->width) * $this->height;
        }
        imagecopyresampled($this->new, $this->img, 0, 0, 0, 0, $new_width, $new_height, $this->width, $this->height);
        imagecopy($this->new, $_mark,$this->width-5,$this->height-5, 0, 0, $_mark_width, $_mark_height);
        imagedestroy($_mark);
    }

    // 固定长高容器 等比例
    public function thumb($new_width = 0, $new_height = 0)
    {
        if (empty($new_width) || empty($new_height)) {
            $new_width = $this->width;
            $new_height = $this->height;
        }
        if (! is_numeric($new_width) || ! is_numeric($new_height)) {
            $new_width = $this->width;
            $new_height = $this->height;
        }
        $width = $new_width;
        $height = $new_height;
        
        // 裁剪点
        $_cut_width = 0;
        $_cut_height = 0;
        if ($this->width < $this->height) {
            $new_width = ($new_height / $this->height) * $this->width;
        } else {
            $new_height = ($new_width / $this->width) * $this->height;
        }
        
        if ($new_width < $width) {
            $r = $width / $new_width;
            $new_width *= $r;
            $new_height *= $r;
            $_cut_height = ($new_height - $height) / 2;
        }
        if ($new_height < $height) {
            $r = $height / $new_height;
            $new_width *= $r;
            $new_height *= $r;
            
            $_cut_width = ($new_width - $width) / 2;
        }
        if ($_cut_height < 0)
            $_cut_height = 0;
        if ($_cut_width < 0)
            $_cut_width = 0;
        
        $this->new = imagecreatetruecolor($width, $height);
        imagecopyresampled($this->new, $this->img, 0, 0, $_cut_width, $_cut_height, $new_width, $new_height, $this->width, $this->height);
    }

    // 加载图片
    private function getFromImg($_file, $_type)
    {
        switch ($_type) {
            case 1:
                $img = imagecreatefromgif($_file);
                break;
            case 2:
                $img = imagecreatefromjpeg($_file);
                break;
            case 3:
                $img = imagecreatefrompng($_file);
                break;
            default:
                Tool::alertBack('ERROR---请上传gif,jpg,png 类型图片');
                break;
        }
        return $img;
    }

    public function out()
    {
        switch ($this->type) {
            case 1:
                imagegif($this->new, $this->file);
                break;
            case 2:
                imagejpeg($this->new, $this->file);
                break;
            case 3:
                imagepng($this->new, $this->file);
                break;
        }
        imagedestroy($this->img);
        imagedestroy($this->new);
    }
}

?>