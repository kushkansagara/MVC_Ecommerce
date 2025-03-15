<?php

class Catalog_Model_Resource_Attribute extends core_Model_Resource_Abstract
{

    public function _construct()
    {
        $this->init('catalog_Attribute', 'attribute_id');
    }
}

?>