<?php

class Admin_Model_Resource_User extends core_Model_Resource_Abstract
{

    public function _construct()
    {
        $this->init('Admin_user', 'admin_id');
    }
}
?>