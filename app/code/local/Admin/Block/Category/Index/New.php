<?php
class Admin_Block_Category_Index_New extends Core_Block_Template
{
    protected $_result;
    protected $_categories;
    protected $_editCategory;
    public function getCategory()
    {

        $this->_categories = Mage::getModel('catalog/category')
            ->getCollection()->getData();
        return $this->_categories;
    }
    public function getHtml($field, $data)
    {
        $field = ucfirst(strtolower($field));
        $classname = sprintf("Core_Block_Html_Elements_%s", $field);
        $element = new $classname($data);
        return $element->render();
    }
    public function getProduct()
    {
        $this->categories = Mage::getModel('catalog/category')
            ->getCollection()->getData();
        if (isset($_GET['id'])) {
            $this->_result = Mage::getModel('catalog/product')->load($_GET['id']);
        } else {
            $this->_result = null;
        }

        return $this->_result;
    }
    public function getCategoryForEdit()
    {
        $this->_editCategory = Mage::getModel('catalog/category')->load($_GET['id']);
        return $this->_editCategory;
    }
}
?>