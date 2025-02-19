<?php

class Catalog_Model_Resource_Category extends core_Model_Resource_Abstract
{

    public function _construct()
    {
        $this->init('catlog_category', 'category_id');
    }
}

?>