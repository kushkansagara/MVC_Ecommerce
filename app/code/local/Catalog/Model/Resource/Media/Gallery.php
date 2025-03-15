<?php

class Catalog_Model_Resource_media_gallery extends core_Model_Resource_Abstract
{

    public function _construct()
    {
        $this->init('catalog_media_gallery', 'media_id');
    }
}
?>