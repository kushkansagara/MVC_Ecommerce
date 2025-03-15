<?php
class Admin_Block_Product_Index_List extends Core_Block_Template
{
    // public function __construct()
    // {
    //     $this->setTemplate('catalog/product/list.phtml');
    // }
    protected $_result;
    public $catData;
    // }
    public function __construct()
    {

        // print_r($this->product);
        // $this->setTemplate('Admin/product/index/new.phtml');

        // print_r($_result);
        // return $_result;
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