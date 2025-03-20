<?php
class Admin_Block_Product_Index_List extends Core_Block_Template
{
    protected $_result;
    public $catData;
    public function __construct()
    {

    }
    public function getProduct()
    {

        $product = Mage::getSingleton('catalog/filter')
            ->getProductionCollection()
            ->addAttributeToSelect(["warranty", "color"]);
        ;
        return $product->getData();
    }

}
?>