<?php

class WorkSheet
{
    private $lines = array();
    public $sWorksheetTitle;
    public function __construct($sWorksheetTitle)
    {
        $this->setWorksheetTitle($sWorksheetTitle);
    }
    public function setWorksheetTitle ($title)
    {
        $title = preg_replace ("/[\\\¦:¦\/¦\?¦\*¦\[¦\]]/", "", $title);
        $title = substr ($title, 0, 31);
        $this->sWorksheetTitle = $title;
    }
    public function addRow ($array)
    {
        $cells = "";
        foreach ($array as $k => $v){
            $type = 'String';
            $v = htmlentities($v, ENT_COMPAT, "UTF-8");
            $cells .= "<Cell><Data ss:Type=\"$type\">" . $v . "</Data></Cell>\n";
        }
        $this->lines[] = "<Row>\n" . $cells . "</Row>\n";
    }
    public function printline()
    {
        foreach ($this->lines as $line)
        {
            return $line;
        }
    }
}



