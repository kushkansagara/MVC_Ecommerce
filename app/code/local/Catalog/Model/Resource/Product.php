<?php

class Catalog_Model_Resource_Product extends core_Model_Resource_Abstract
{
    public function _construct()
    {
        $this->init('catlog_product', 'product_id');
    }
}
?>