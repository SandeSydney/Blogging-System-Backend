<?php

//class for the page data
class Display_Data
{
    public $title = "";
    public $content = "";
    public $css = "";
    public $embeddedStyle = "";
    public $scriptElements = ""; 

    //method for adding javascript
    public function addScript($src){
        $this->scriptElements .= "<script src='$src'></script>";
    }

    //stylesheets reuse object method
    public function addCSS($href){
        $this->css .= "<link href='$href' rel='stylesheet'>";
    }
}
