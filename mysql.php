<?php
class mysqlcc{
    public $host;
    public $pass;
    public $user;
    public $mydb;
    public $qq;
    public $flomoapi;

    public function find_sql(){
        $qq=$this->qq;
        $link = @mysqli_connect($this->host,$this->user,$this->pass,$this->mydb);
        if(mysqli_connect_errno($link)){
                mysqli_connect_errno($link);
                exit;
        }
        mysqli_query($link,"set names utf8");
        $sql = "select * from flomoapi";
        $result = mysqli_query($link,$sql);
        $n=0;
        $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
        $i=0;
        for($i=0;$i<count($data);$i++){
            $chen=$data[$i];
            if($chen['qq']==$qq){return $chen['flomoapi'];$n=1;}
        }
        if($n=='0'){return 'ccnull';};
        mysqli_close($link);
    }

    public function up_sql(){
        $qq=$this->qq;
        $flomoapi=$this->flomoapi;
        $link = @mysqli_connect($this->host,$this->user,$this->pass,$this->mydb);
        if(mysqli_connect_errno($link)){
                mysqli_connect_errno($link);
                exit;
        }
        mysqli_query($link,"set names utf8");
        $sql = "UPDATE flomoapi SET flomoapi='{$flomoapi}' WHERE qq='{$qq}';";
        $result = mysqli_query($link,$sql);
        return $result;
        mysqli_close($link);
    }

    public function in_sql(){
        $qq=$this->qq;
        $flomoapi=$this->flomoapi;
        $link = @mysqli_connect($this->host,$this->user,$this->pass,$this->mydb);
        if(mysqli_connect_errno($link)){
                mysqli_connect_errno($link);
                exit;
        }
        mysqli_query($link,"set names utf8");
        $sql = "insert into flomoapi values('{$qq}','{$flomoapi}');";
        $result = mysqli_query($link,$sql);
        return $result;
        mysqli_close($link);
    }
    
    public function set_sql(){
        $this->flomoapi='null';
        $this->in_sql();
    }
    
    public function del_sql(){
        $this->flomoapi='null';
        $this->up_sql();
    }
}
?>