<?php
class Admin_Block_Product_Index_New extends Core_Block_Template
{
    // public function __construct()
    // {
    protected $_result;
    public $categories = [];
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

        // $this->_result = Mage::getModel('catalog/product')
        //     ->load($_GET['id'])
        // ;
        $this->categories = Mage::getModel('catalog/category')
            ->getCollection()->getData();
        ;

        if (isset($_GET['id'])) {
            $this->_result = Mage::getModel('catalog/product')->load($_GET['id']);
        } else {
            $this->_result = null;
        }

        return $this->_result;
    }

    public function getHtmlField($field, $data)
    {
        $field = ucfirst(strtolower($field));
        $classname = sprintf("Admin_Block_Html_Elements_%s", $field);
        $element = new $classname($data);
        return $element->render();


    }
}


?>