<?php
class qqapi{
    public $qq;
    public $qqqun;
    public $url;
    public $msg;
    public $flag;
    public $access_token;
    public function send_post($url, $post_data) {
          $postdata = http_build_query($post_data);
          $options = array(
            'http' => array(
              'method' => 'POST',
              'header' => array('Content-Type:application/x-www-form-urlencoded',"Authorization:Bearer {$this->access_token}",'charset:utf-8','Accept:application/json'),
              'content' => $postdata,
              'timeout' => 15 * 60
            )
          );
          $context = stream_context_create($options);
          $result = file_get_contents($url, false, $context);
          return $result;
        }
        
    public function send1(){
        $url=$this->url.'send_private_msg';
            $postdata = array(
                  'user_id' => $this->qq,
                  'message' => $this->msg,
                  'auto_escap' => 'true'
                );
            $this->send_post($url,$postdata);
        }
        
    public function send2(){
        $url=$this->url.'send_group_msg';
            $postdata = array(
                  'group_id' => $this->qqqun,
                  'message' => $this->msg,
                  'auto_escap' => 'true'
                );
            $this->send_post($url,$postdata);
        }
    
    public function send3(){
        $url=$this->url.'set_friend_add_request';
            $postdata = array(
                  'flag' => $this->flag,
                  'approve' => 'true',
                  'remark'=>''
                );
            $this->send_post($url,$postdata);
        }
}
?>