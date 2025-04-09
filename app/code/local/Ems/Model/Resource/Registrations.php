<?php

class Ems_Model_Resource_Registrations extends core_Model_Resource_Abstract
{

    public function _construct()
    {
        $this->init('ems_registrations', 'id');
    }
}
?>