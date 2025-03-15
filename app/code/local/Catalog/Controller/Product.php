<?php

class Catalog_Controller_Product
{

    public function viewAction()
    {
        $layout = Mage::getBlock('Core/Layout');
        $view = $layout->createBlock('Catalog/Product_View')->setTemplate('catalog/product/view.phtml');
        $layout->getChild('content')->addChild('view', $view);
        $layout->getChild('head')->addCss('catalog/product/view.css')
            ->addJs('catalog/product/view.js');
        $layout->toHtml();
    }
    public function listAction()
    {
        $layout = Mage::getBlockSingleton('Core/Layout');
        $list = $layout->createBlock('Catalog/Product_List')
            ->setTemplate('catalog/product/list.phtml');
        $layout->getChild('content')->addChild('list', $list);
        $layout->getChild('head')->addCss('catalog/product/list.css')->addJs('catalog/product/list/filter.js');
        $layout->toHtml();
    }

    public function TestAction()
    {
        $itemCollection = Mage::getSingleton("checkout/session")
            ->getCart()
            ->getItemCollection(5);

        $itemCollection->select(['SUM(main_table.subtotal)' => 'sub_total', 'item_id']);
        Mage::log($itemCollection->prepareQuery());
    }
}
?>