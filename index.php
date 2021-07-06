<?php
$access_token='flomoapi';
$qqurl='http://127.0.0.1:5700/';

require 'flomo.php';
require 'qqapi.php';
require 'sqlite.php';
$flomo=new flomoapp();
$qq=new qqapi();
$qq->url=$qqurl;
$qq->access_token=$access_token;
$post= file_get_contents("php://input");
// $myfile = fopen("logfile", "a") or die("Unable to open file!");
// fwrite($myfile, $post."\n");
// fclose($myfile);
$chen=json_decode($post);
$pt=$chen->post_type;
if($pt!='message'){
    if(($pt=='request')&&($chen->request_type='friend')&&(strstr($chen->comment,'flomo'))){
        $qq->flag=$chen->flag;
        $qq->send3();
    }
    else goto end;
}
$mt=$chen->message_type;
if($mt=='private'){
    $rmsg=$chen->raw_message;
    $uid=$chen->sender->user_id;
    $nic=$chen->sender->nickname;
    $sex=$chen->sender->sex;
    $rem=$chen->sender->remark;
    $time=$chen->time;
    $qq->qq=$uid;
    $qqsql=$uid;
    
    $flomoapicc=find_sql($qqsql);
    if($flomoapicc=='ccnull'){
        set_sql($qqsql);
        $qq->msg="📝 发送 绑定+你的flomo api 即可绑定。\r\n✨ 如何获取 api？ https://flomoapp.com/mine?source=incoming_webhook\r\n🥺 更多帮助 https://help.flomoapp.com/advance/extension/qqbot\r\n(此消息仅显示一次)";
        $qq->send1();
    }
    
    if($flomoapicc=='null'){
        $msg=$chen->message[0]->data->text;
        if(!empty($msg)){
            if(strstr($msg,'绑定https://flomoapp.com/iwh/')){
                $zzz=str_replace('绑定','',$msg);
                $flomoapisql=$zzz;
                up_sql($qqsql,$flomoapisql);
                $qq->msg="绑定成功\r\n发送文字或图片，即可保存到 flomo";
                $qq->send1();
            }
        }
        goto end;
    }
    
    else{
    $flomo->flomoapi=$flomoapicc;
    if(count($chen->message)==1){
    $mtp=$chen->message[0]->type;
    if($mtp=='text'){
    $msg=$chen->message[0]->data->text;
    
    if(!empty($msg)){
            if(strstr($msg,'解除绑定')){
                del_sql($qqsql);
                $qq->msg="已解除绑定";
                $qq->send1();
                goto end;
            }
            else if(strstr($msg,'重新绑定https://flomoapp.com/iwh/')){
                $zzz=str_replace('重新绑定','',$msg);
                $flomoapisql=$zzz;
                up_sql($qqsql,$flomoapisql);
                $qq->msg="重新绑定成功\r\n发送文字或图片，即可保存到 flomo";
                $qq->send1();
                goto end;
            }
        }
    
    $flomo->content=$msg;
    $rs=$flomo->flomotext();
    $rs=json_decode($rs);
    if($rs->code==0){
    $str="已记录\r\n可继续批注：https://flomoapp.com/mine?memo_id=";
    $qq->msg=$str.$rs->memo->slug;
    $qq->send1();}
    else if($rs->code==-1){
        del_sql($qqsql);
        $qq->msg="验证失败，请发送 绑定+你的flomo api 重新绑定";
        $qq->send1();
    }
    }
    else if($mtp=='image'){
        $fileurl=$chen->message[0]->data->url;
        $flomo->fileurl=$fileurl;
        $rs=$flomo->flomopic();
        $mm=$rs;
        $rs=json_decode($rs);
        if($rs->code==0){
            $str="已记录\r\n可继续批注：https://flomoapp.com/mine?memo_id=";
            $qq->msg=$str.$rs->memo->slug;
            $qq->send1();}
            else if($rs->code==-1){
                del_sql($qqsql);
                $qq->msg="验证失败，请发送“重新绑定+你的flomo api”重新绑定";
                $qq->send1();
    }
    }
    }
    else{
        $count=count($chen->message);
        if($count==2){
        for($i=0;$i<$count;$i++){
            $mtp=$chen->message[$i]->type;
            if($mtp=='text'){
            $msg=$chen->message[$i]->data->text;
            $flomo->content=$msg;
            }
            else if($mtp=='image'){
                $fileurl=$chen->message[$i]->data->url;
                $flomo->fileurl=$fileurl;}
        }
        $rs=$flomo->flomopic();
        $rs=json_decode($rs);
        if($rs->code==0){
            $str="已记录\r\n可继续批注：https://flomoapp.com/mine?memo_id=";
            $qq->msg=$str.$rs->memo->slug;
            $qq->send1();}
            else if($rs->code==-1){
                del_sql($qqsql);
                $qq->msg="验证失败，请发送“重新绑定+你的flomo api”重新绑定";
                $qq->send1();
              }
        }
        else {$qq->msg="消息中元素过多！";
        $qq->send1();}
    }
    }
}//如果是私聊消息
else if($mt='group'){

}//如果是群聊消息
else goto end;
end:
?>
