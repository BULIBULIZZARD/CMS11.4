<?php
require '../init.inc.php';
try {
    if (isset($_GET['type'])){
        if(isset($_FILES['upload'])) { 
            $_ckefn = new FileUpload('upload',204800);
            $_path = $_ckefn->getPath();
            $_img=new Image($_path);
            $_img->ckeImg(650,0);
            $_img->out();
            echo "<script>window.parent.CKEDITOR.tools.callFunction(1,\"$_path\", 1);</script>" ;//图片上传成功，通知ck图片的url
        } 
    }else {
        Tool::alertBack('ERROR---错误的上传方式');
    }
}catch (Exception $e) {
    $error= $e->getMessage();
    echo "<script>window.parent.CKEDITOR.tools.callFunction(1, 1, '$error');</script>" ;//图片上传失败，通知ck失败消息
}  
?>