<?php

class Ems_Model_Events extends Core_Model_Abstract
{

    public function init()
    {
        $this->_resourceClassName = "Ems_Model_Resource_Events";
        $this->_collectionClassName = "Ems_Model_Resource_Events_Collection";
    }
}
?>