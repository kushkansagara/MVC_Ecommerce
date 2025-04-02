<?php

class Catalog_Controller_Category
{
    public function listAction()
    {
        $layout = Mage::getBlock('Core/Layout');
        $list = $layout->createBlock('Catalog/Category_List');
        // ->setTemplate('catalog/category/list.phtml');
        $layout->getChild('content')->addChild('list', $list);

        $layout->toHtml();
    }
}

?>