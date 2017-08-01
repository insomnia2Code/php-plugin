<?php
include_once('excel-table/Excel.php');

$data = [
    ['a', 'b', 'c', 'd'],
    ['a', 'b', 'c', 'd'],
    ['a', 'b', 'c', 'd'],
    ['a', 'b', 'c', 'd'],
    ['a', 'b', 'c', 'd'],
    ['a', 'b', 'c', 'd'],
];

$a = new Excel();
$a->excelData($data,'test', time().'.xls');


