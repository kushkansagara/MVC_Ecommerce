<?php
class Admin_Block_Product_Index_New extends Core_Block_Template
{
    // public function __construct()
    // {
    protected $_result;
    protected $_attribute;
    public $categories = [];
    protected $_categories;
    protected $_product;
    // }
    public function __construct()
    {

    }
    public function getProduct()
    {
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

    public function getHtml($field, $data)
    {
        $field = ucfirst(strtolower($field));
        $classname = sprintf("Core_Block_Html_Elements_%s", $field);
        $element = new $classname($data);
        return $element->render();
    }

    public function getCategories()
    {
        $data = Mage::getModel('catalog/category')->getCollection()->getData();
        // echo "<pre>";
        // print_r($data);
        // die;
        return $data;
    }
    public function getAttributeCol()
    {
        $request = Mage::getModel("core/request");
        $id = $request->getQuery('id');
        return Mage::getModel('catalog/attribute')
            ->getCollection()->getData();
        // $data = $product->getData();
        // return $data;
    }
    public function getAttribute()
    {
        $request = Mage::getModel("core/request");
        $id = $request->getQuery('id');
        return Mage::getModel('catalog/product_attribute')
            ->load($id);
    }
    public function getImage()
    {
        $request = Mage::getModel("core/request");
        $id = $request->getQuery('id');
        return Mage::getModel('catalog/media_gallery')
            ->getCollection()
            ->addFieldToFilter('product_id', $id)
            ->getData();
    }
}