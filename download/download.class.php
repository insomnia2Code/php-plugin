<?php

class download{

    protected static $num = 2452;

    protected static $sourceUrl = 'https://wallpapers.wallhaven.cc/wallpapers/full/wallhaven-';

    protected static $savePath = 'save';


    public function start()
    {
        while(true) {
            $url = self::$sourceUrl . self::$num . '.jpg';
            $filename = 'wallhaven-' . self::$num . '.jpg';
            $res = $this->getImage($url, self::$savePath, $filename);
            if (!$res) {
                file_put_contents('file.log', $res ."\r\n", FILE_APPEND);
            }
            self::$num++;
            sleep(1);
        }
    }


    function getImage($url,$save_dir='',$filename='',$type=1){
        if(trim($url)==''){
            return array('file_name'=>'','save_path'=>'','error'=>1);
        }
        if(trim($save_dir)==''){
            $save_dir='./';
        }
        if(trim($filename)==''){//保存文件名
            $ext=strrchr($url,'.');
            if($ext!='.gif'&&$ext!='.jpg'){
                return array('file_name'=>'','save_path'=>'','error'=>3);
            }
            $filename=time().$ext;
        }
        if(0!==strrpos($save_dir,'/')){
            $save_dir.='/';
        }
        //创建保存目录
        if(!file_exists($save_dir)&&!mkdir($save_dir,0777,true)){
            return array('file_name'=>'','save_path'=>'','error'=>5);
        }
        //获取远程文件所采用的方法
        if($type){
            $ch=curl_init();
            $timeout=60;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
//            curl_setopt($ch, CURLOPT_PROXY, '127.0.0.1:8080');
            $img=curl_exec($ch);
//            var_dump($img);
            curl_close($ch);
        }else{
            ob_start();
            readfile($url);
            $img=ob_get_contents();
            ob_end_clean();
        }
        //$size=strlen($img);
        //文件大小
//        $fp2 = @fopen($save_dir.$filename,'a');
//        fwrite($fp2,$img);
//        fclose($fp2);
//        unset($img,$url);
        $local_file = fopen($save_dir.$filename, 'w');
        if (false !== $local_file) {
            if (false !== fwrite($local_file, $img)) {
                fclose($local_file);
                return true;
            }
        }
        return false;
    }


}