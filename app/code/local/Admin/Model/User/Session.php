<?php

class Admin_Model_User_Session extends Core_Model_Session
{
    public function getRole()
    {
        $role_id = $this->get('role_id');
        $role = Mage::getModel('Admin/Role')->load($role_id);
        return $role;
    }
}
?>