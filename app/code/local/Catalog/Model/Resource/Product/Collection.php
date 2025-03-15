<?php

class Catalog_Model_Resource_Product_Collection extends core_Model_Resource_Collection_Abstract
{

    public function addAttributeToSelect($attributes)
    {

        foreach ($attributes as $attribute) {
            $a = Mage::getModel("catalog/attribute")
                ->load($attribute, "name");
            $attribute_id = $a->getAttributeId();
            $this->joinLeft(
                ["cpa_{$a->getName()}" => "catalog_product_attribute"],
                "main_table.product_id=cpa_{$a->getName()}.product_id 
                AND cpa_{$a->getName()}.attribute_id={$attribute_id}",
                [$a->getName() => "value"]
            );
        }

        return $this;
    }
    public function addCategoryFilter($category)
    {
        // $category = explode(",", $category);
        $this->addFieldToFilter('category_id', ['IN' => $category]);
        return $this;

    }
    public function addAttributeToFilter($attribute, $value)
    {
        $this->addAttributeToSelect([$attribute]);
        // $value = explode(',', $value);
        $this->addFieldToFilter("cpa_{$attribute}.value", ['IN' => $value]);
    }
}

?>