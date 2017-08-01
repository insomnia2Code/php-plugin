<?php
include_once('Sheet.php');

class Excel
{
    public $worksheets = array();
    public function __construct($sWorksheetTitle)
    {
        $this->addsheet($sWorksheetTitle);
    }
    public function addsheet($title)
    {
        $this->worksheets[$title] = new WorkSheet($title);
    }
    public function generate ($filename = 'excel-export')
    {
        $filename = preg_replace('/[^aA-zZ0-9\_\-]/', '', $filename);
        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        header("Content-Disposition: inline; filename=\"" . $filename . ".xls\"");
        $str =  stripslashes("<?xml version=\"1.0\" encoding=\"UTF-8\"?\>\n<Workbook xmlns=\"urn:schemas-microsoft-com:office:spreadsheet\" xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns:ss=\"urn:schemas-microsoft-com:office:spreadsheet\" xmlns:html=\"http://www.w3.org/TR/REC-html40\">");
        foreach ($this->worksheets as $worksheet)
        {
            $str .= "\n<Worksheet ss:Name=\"" . $worksheet->sWorksheetTitle . "\">\n<Table>\n";
            $str .= $worksheet->printline();
            $str .=  "</Table>\n</Worksheet>\n";
        }
        $str .=  "</Workbook>";
        exit($str);
    }
}