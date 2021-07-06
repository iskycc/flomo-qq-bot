<?php
require 'vendor/autoload.php';
class flomoapp{
    public $flomoapi;
    public $fileurl;
    public $content;
    public $flomoclinet;
    
    public function flomotext() {
    $this->flomoclient=new GuzzleHttp\Client();
    $content=$this->content."\r\n#viachen";
    $flomoapi=$this->flomoapi;
    $response=$this->flomoclient->request('POST',$flomoapi,[
        'json' => ['content' => $content]
        ]
    );
    $result=$response->getBody()->getContents();
    return $result;
    }
    
    public function flomopic(){
        $this->flomoclient= new GuzzleHttp\Client();
        $flomoapi=$this->flomoapi;
        $fileurl=$this->fileurl;
        $response=$this->flomoclient->request('POST',$flomoapi.'file',[
            'multipart'=>[[
                'name'=>'file',
                'contents'=>file_get_contents($fileurl),
                'filename'=>$fileurl
        ]
        ]
        ]);
        $chen=$response->getBody()->getContents();
        $chen=json_decode($chen);
        $chen=$chen->file;
        if(empty($this->content)){
            $response1=$this->flomoclient->request('POST',$flomoapi,[
            'json'=>[
                'content'=>"#viachen",
                'file_ids'=>$chen
                ]
                ]
        );
        }
        else{
            $response1=$this->flomoclient->request('POST',$flomoapi,[
            'json'=>[
                'content'=>$this->content."\r\n#viachen",
                'file_ids'=>$chen
                ]
                ]
        );
        }
        $result=$response1->getBody()->getContents();
        return $result;
    }
}

?>