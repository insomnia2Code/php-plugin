<?php

class download{

    protected static $num = '1000,1008,1015,1016,1017,1018,1028,1029,1030,1037,1058,106,1076,1079,1084,1107,1118,1124,1125,1126,1131,1132,1134,1136,1145,1146,1159,1160,1166,1176,1192,1221,1228,1233,1287,1291,130,1301,1302,1319,1355,1359,136,1360,1361,1368,142,1436,1444,1519,1540,160,1633,1709,174,1743,1788,1845,1850,1859,186,1867,1883,1886,1887,1892,1899,1900,1909,1919,1928,1930,1943,1945,1946,1954,1958,1964,1980,1996,1997,1998,1999,2000,2001,2016,2019,2023,2032,2041,2061,2082,2088,211,2110,2112,2113,2114,2117,216,2185,220,2210,2213,2214,2221,224,2247,226,227,229,230,2301,2302,2304,2305,231,2315,2324,2339,2340,235,2351,236,2361,237,2378,238,2382,239,2395,2399,2405,2435,2440,2445,246,248,2483,2489,250,2501,2513,2514,252,2539,2543,255,2550,257,258,2584,259,260,261,262,263,2635,264,265,266,2675,2698,271,272,273,2739,2740,2742,2746,2764,2777,2796,2799,2814,283,291,2913,2921,2929,2932,2936,2938,2947,2969,2972,2978,2980,2985,2997,30,3006,3008,3015,3029,3032,3033,3041,3045,3065,3073,3074,3078,3091,3137,314,3214,3219,3229,3241,3242,3243,3244,3245,3247,3253,3260,3261,3262,3264,3265,3266,3267,3268,3269,3270,3271,3272,3273,3274,3289,3290,3291,3292,3310,3311,3322,3338,3340,3351,3357,3360,3361,3377,338,339,3399,3414,343,3479,3480,3484,349,3516,3517,352,3526,3529,3530,3531,3533,3536,3540,3541,3554,3556,3568,3583,360,3620,3626,3663,3708,3725,3737,3758,3766,3786,3792,3794,3864,3896,3900,3940,3947,4022,4054,4055,4056,4057,407,4070,4133,4145,4159,4198,4206,423,4231,4237,424,4247,4248,4249,425,4250,4251,426,429,4295,431,4312,4328,4332,436,441,4411,4458,4475,4495,4503,4508,4522,4547,4548,4550,4551,4578,4581,4599,4600,4601,4602,4603,4604,4605,4606,4607,4608,4609,4610,4612,4614,4615,4616,4637,4641,4647,4650,4654,4655,4658,4661,467,4675,4687,4728,4749,4762,4764,4766,477,4788,4794,4800,4801,4804,4834,4870,4905,4913,493,4965,4981,5020,5040,5044,5054,5055,506,5060,5061,5062,5064,5067,5068,507,5071,5083,5085,5098,5143,5149,516,5160,5167,5168,5169,5189,5203,521,5212,5214,525,526,5270,5271,5272,5273,5274,5275,5276,5279,5294,530,5301,5315,5318,5319,5322,5337,5344,5361,5379,5380,5388,5395,5398,5401,5406,5408,5432,5448,5495,5499,5510,5529,5586,5588,5604,5612,5639,5661,5662,5670,5673,5674,5695,5707,5724,5825,5828,5829,5832,5838,5847,5858,5859,5865,5868,5872,59,593,5932,594,595,5954,5959,5997,604,6046,6087,6112,6124,6141,6143,6145,6166,6167,6168,6169,6174,618,6184,619,6193,6194,6198,620,6200,6201,6206,6208,621,622,623,6233,6235,6237,6238,624,6241,6311,6404,6426,6427,6444,6457,6471,6531,6534,6572,6578,6585,66,67,68,69,7,70,71,72,73,74,740,75,76,763,765,766,768,77,78,79,80,841,85,852,859,862,868,869,882,903,905,907,913,915,930,934,935,936,947,957,965,966,981,991';

    protected static $sourceUrl = 'https://wallpapers.wallhaven.cc/wallpapers/full/wallhaven-';

    protected static $savePath = 'save2';


    public function start()
    {
        $arr = explode(',', self::$num);
        foreach($arr as $num){
            $url = self::$sourceUrl . $num . '.jpg';
            $filename = 'wallhaven-' . $num . '.jpg';
            $res = $this->getImage($url, self::$savePath, $filename);
            if (!$res) {
                file_put_contents('file.log', $res ."\r\n", FILE_APPEND);
            }
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
            $timeout=5;
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