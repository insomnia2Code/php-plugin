<?php

class Excel{

    public function excelData($datas,$titlename,$filename){
        $str = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\"\r\nxmlns:x=\"urn:schemas-microsoft-com:office:excel\"\r\nxmlns=\"http://www.w3.org/TR/REC-html40\">\r\n<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<head>\r\n<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">\r\n</head>\r\n<body>";
        $str .="<table border=1><head>".$titlename."</head>";

        /**
         * 扩展头部样式
         */
        //$str .= '<tr><th></th></tr>';

        foreach ($datas  as $key => $rt )
        {
            //扩展样式
//            $align = isset($srt['align']) ? 'align:' . $srt['align'] : '';
//            $border = isset($srt['border']) ? 'border:' . $srt['border'] : '';
//            $color = isset($srt['color']) ? 'color:' . $srt['color'] : '';
//            $str .= "<tr style='{$align}{$border}{$color}'>";

            $str .= "<tr>";
            foreach ( $rt as $k => $v )
            {
                $str .= "<td>{$v}</td>";
            }
            $str .= "</tr>\n";
        }

        $str .= "</table></body></html>";
        header( "Content-Type: application/vnd.ms-excel; name='excel'" );
        header( "Content-type: application/octet-stream" );
        header( "Content-Disposition: attachment; filename=".$filename );
        header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
        header( "Pragma: no-cache" );
        header( "Expires: 0" );
        exit( $str );
    }
}