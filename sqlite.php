<?php
class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('flomo.db');
      }
   }
 
function find_sql($qq){
    $db = new MyDB();        
    $sql = "select * from flomoapi";
    $ret = $db->query($sql);
    $n=0;
    while($chen= $ret->fetchArray(SQLITE3_ASSOC) ){
        if($chen['qq']==$qq){return $chen['flomoapi'];$n=1;}
    }
    if($n=='0'){return 'ccnull';};
    $db->close();
}

function up_sql($qq,$flomoapi){
    $db = new MyDB();
    $sql = "UPDATE flomoapi SET flomoapi='{$flomoapi}' WHERE qq='{$qq}';";
    $ret = $db->exec($sql);
    $db->close();
    return $ret;
}

function in_sql($qq,$flomoapi){
    $db = new MyDB();
    $sql = "insert into flomoapi values('{$qq}','{$flomoapi}');";
    $ret = $db->exec($sql);
    $db->close();
    return $ret;
}
    
function set_sql($qq){
    $flomoapi='null';
    in_sql($qq,$flomoapi);
}
    
function del_sql($qq){
    $flomoapi='null';
    up_sql($qq,$flomoapi);
}

?>