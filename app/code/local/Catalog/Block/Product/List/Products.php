<?php

class Catalog_Block_Product_List_Products extends Catalog_Block_Product_List
{
    protected $_collection;

    public function __construct()
    {
        $this->setTemplate('catalog/product/list/products.phtml');
        $toolbar = Mage::getBlock('Catalog/Grid_Toolbar');

        $this->addChild('toolbar', $toolbar);
        $this->init();
    }
    public function init()
    {
        $this->_collection = Mage::getSingleton('catalog/filter')
            ->getProductionCollection();
        $this->getChild('toolbar')->prepareToolbar();
    }
    public function getCollection()
    {
        return $this->_collection;
    }
    public function getProduct()
    {
        return $this->getCollection()->getData();

    }
}
?>