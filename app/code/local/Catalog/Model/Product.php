<?php

class Catalog_Model_Product extends Core_Model_Abstract
{
    // protected $_resourceClassName;
    public $status = [
        0 => "diseble",
        1 => "enable",
    ];

    public function init()
    {
        $this->_resourceClassName = "Catalog_Model_Resource_Product";
        $this->_collectionClassName = "Catalog_Model_Resource_Product_Collection";
    }

    public function getStatusText()
    {
        if ($this->status[$this->getStatus()]) {
            return $this->status[$this->getStatus()];
        } else {
            return "NA";
        }
        // return 



    }

}
?>