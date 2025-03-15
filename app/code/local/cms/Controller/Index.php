<?php

class Cms_Controller_Index extends Core_Controller_Front_Action
{
    // public $media;
    public function __construct()
    {
        $layout = Mage::getBlock('core/Layout');

        // die;
        $index = $layout->createBlock('cms/index')
            ->setTemplate('cms/index/slider.phtml');

        $HomeProduct = $layout->createBlock('cms/index')
            ->setTemplate('cms/index/homeproduct.phtml');
        $layout->getChild('content')->addChild('index', $index)->addChild('homeproduct', $HomeProduct);


        $layout->toHtml();
    }
    public function indexAction()
    {
        echo "hello";

        echo get_class() . "----" . __FUNCTION__;

    }
}
?>