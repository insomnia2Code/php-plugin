<?php
include_once('excel-xml/Excel.php');

$xls = new Excel('Sheet'); //构造函数，参数为第一个sheet名称
$xls->worksheets['Sheet']->addRow(array("1","2","3")); //添加一行，数据为1,2,3
$xls->addsheet('Test');//新建一个sheet，参数为sheet名称
$xls->worksheets['Test']->addRow(array("3","2","3"));//在第二个sheet添加一行
$xls->generate('my-test');//下载excel，参数为文件名



