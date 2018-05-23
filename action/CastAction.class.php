<?php

class CastAction extends Action
{

    // 构造方法
    public function __construct(&$_tpl)
    {
        parent::__construct($_tpl,new VoteModel());
        
    }
    
    public function _action(){
        $this->setCount();
        $this->getVote();
    }
    
    private function setCount(){
        if(isset($_POST['send'])){
            isset($_POST['vote'])?true:Tool::alertClose('请选择一个投票项目');
            
            if($_COOKIE['ip']==$_SERVER["REMOTE_ADDR"]){
                if(time()-$_COOKIE['time']<86400){
                    Tool::alertLocation('您的已投票成功,请不要重复投票!','cast.php'); 
                }
            }
            $this->_model->id=$_POST['vote'];
            setcookie('ip',$_SERVER["REMOTE_ADDR"]);
            setcookie('time',time());
            $this->_model->setCount()?Tool::alertLocation('投票成功,感谢您的支持!',"cast.php"):Tool::alertClose('投票失败请重试');
        }
    }
    private function getVote(){
        $_vote=new VoteModel();
        $_title=$_vote->getShowVoteTitle();
        $_sum=$_vote->getVoteSum()->c;
        $_width=400;
        $_object=$_vote->getShowChild();
        if($_object){
            $_i=1;
            foreach ($_object as $_value){
                $_value->parcent= round($_value->count/$_sum*100,2).'%';
                $_value->picwidth=$_value->count/$_sum*$_width;
                $_value->picnum=$_i;
                $_i++;
            }
        }
        $this->_tpl->assgin('width',$_width);
        $this->_tpl->assgin('votetitle',$_title->title);
        $this->_tpl->assgin('voteChild',$_object);
    }
}

?>
