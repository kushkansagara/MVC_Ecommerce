<?php

class Page_Block_content extends Core_BLock_Template
{
    public function __construct()
    {
        $this->setTemplate('page/content.phtml');
    }

    public function getAllowedPermission($argument)
    {
        $permission = Mage::getModel('admin/user_session')->getRole()->getPermissions();

        $arr = json_decode($permission, true);
        $argument = explode('/', $argument);
        $key = $argument[0];
        $Adminpermission = $argument[1];

        if (isset($arr[$key]) && in_array($Adminpermission, $arr[$key])) {
            return true;
        } else {
            return false;
        }
    }
}
?>