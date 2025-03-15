<?php

class Page_Block_Footer extends Core_BLock_Template
{
    public function __construct()
    {
        $this->setTemplate('page/footer.phtml');
        // $this->getChild('head')->addCss('page/footer.css')->addJs('page/footer.js');
    }
}

?>