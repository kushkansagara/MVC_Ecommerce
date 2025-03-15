<?php
class Catalog_Model_Filter extends Core_Model_Abstract
{
    public function getProductionCollection()
    {
        $collection = Mage::getSingleton('Catalog/product')->getCollection();
        $this->applyFilter($collection);
        return $collection;
    }
    public function applyFilter($collection)
    {
        $request = Mage::getSingleton('core/request');
        $parameter = $request->getQuery();
        if (isset($parameter['category'])) {
            $collection->addCategoryFilter($parameter['category']);
            unset($parameter['category']);
        }
        if (!empty($parameter)) {
            $attributes = Mage::getModel('catalog/attribute')->getCollection()->addFieldToFilter('name', ['IN' => array_keys($parameter)]);
            foreach ($attributes->getData() as $attribute) {
                $collection->addAttributeToFilter($attribute->getName(), $parameter[$attribute->getName()]);
            }
        }
    }
}
?>