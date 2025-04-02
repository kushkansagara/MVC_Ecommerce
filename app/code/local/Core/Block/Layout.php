<?php
class Core_Block_Layout extends Core_Block_Template
{
    protected $_template;
    public function __construct()
    {
        $this->prepareChildren();
        $this->preparJsCss();
        $this->_template = "page/root.phtml";
    }
    public function prepareChildren()
    {
        $header = $this->createBlock('page/head');
        $this->addChild('head', $header);
        $message = $this->createBlock('core/message');
        $this->addChild('message', $message);
        $header = $this->createBlock('page/header');
        $this->addChild('header', $header);
        $content = $this->createBlock('page/content');
        $this->addChild('content', $content);
        $footer = $this->createBlock('page/footer');
        $this->addChild('footer', $footer);
    }


    public function preparJsCss()
    {
        $head = $this->getChild('head');
        $head->addCss('page/common.css')->addJs('page/common.js');
    }


    public function createBlock($block)
    {
        return Mage::getBlock($block);
    }
}
?>