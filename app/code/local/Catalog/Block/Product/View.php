<?php
class Catalog_Block_Product_View extends Core_Block_Template
{
    public function __construct()
    {
        $this->setTemplate('catalog/product/view.phtml');
    }

    public function getProductData()
    {
        $request = Mage::getModel("core/request");
        $id = $request->getQuery('id');
        $product = Mage::getModel('catalog/product')
            ->load($id);
        return $product;
    }

    public function getAttributes()
    {
        $attributes = Mage::getModel("catalog/Attribute")
            ->getCollection();
        return $attributes->getData();
    }
    public function getHtml($field, $data)
    {
        $field = ucfirst(strtolower($field));
        $classname = sprintf("Core_Block_Html_Elements_%s", $field);
        $element = new $classname($data);
        return $element->render();
    }
}
?>