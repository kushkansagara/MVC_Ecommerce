<?php

class Admin_Model_Resource_Role extends core_Model_Resource_Abstract
{

    public function _construct()
    {
        $this->init('Admin_role', 'role_id');
    }
}
?>