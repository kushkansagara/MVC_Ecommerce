<?php
class Core_Block_Layout_Admin extends Core_Block_Layout
{
    protected $_template;
    public function __construct()
    {
        $this->prepareChildren();
        $this->preparJsCss();
        $this->_template = "page/admin/root.phtml";
    }
    public function prepareChildren()
    {
        $header = $this->createBlock('page/header')->setTemplate('page/admin/header.phtml');
        $this->addChild('header', $header);

        $message = $this->createBlock('core/message')->setTemplate('core/message.phtml');
        $this->addChild('message', $message);

        $head = $this->createBlock('page/head')->setTemplate('page/admin/head.phtml');
        $this->addChild('head', $head);

        $content = $this->createBlock('page/content')->setTemplate('page/admin/content.phtml');
        $this->addChild('content', $content);

        $footer = $this->createBlock('page/footer')->setTemplate('page/admin/footer.phtml');
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