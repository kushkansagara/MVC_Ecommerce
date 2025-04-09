<?php

class Ems_Model_Resource_Events extends core_Model_Resource_Abstract
{

    public function _construct()
    {
        $this->init('ems_events', 'id');
    }
}
?>