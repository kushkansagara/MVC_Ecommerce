<?php

class Cms_Controller_Index extends Core_Controller_Front_Action
{
    public function __construct()
    {
        $layout = Mage::getBlock('core/Layout');
        $layout->toHtml();
        // print_r($class);
    }
    public function indexAction()
    {
        echo "hello";

        echo get_class() . "----" . __FUNCTION__;

    }
}
?>