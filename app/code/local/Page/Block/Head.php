<?php

class Page_Block_Head extends Core_Block_Template
{
    protected $_js;
    protected $_css;
    public function __construct()
    {
        $this->setTemplate('page/head.phtml');
    }
    public function addJs($file)
    {
        // echo "$file";
        $this->_js[] = $file;
        return $this;
    }
    public function addCss($file)
    {
        // echo "$file";
        $this->_css[] = $file;
        return $this;
    }
    public function getCss()
    {
        return $this->_css;
    }
    public function getJs()
    {
        return $this->_js;
    }
}
?>