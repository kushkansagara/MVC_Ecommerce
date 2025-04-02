<?php

class Core_Controller_Admin_Action extends Core_Controller_Front_Action
{
    protected $_allowedActions = [];
    protected $_roleAllowedAction = [];

    public function __construct()
    {
        $this->_init();
    }
    protected function _init()
    {

        $isLogin = $this->getSession()->get('login');
        if (!in_array($this->getRequest()->getActionName(), $this->_allowedActions)) {
            // echo $isLogin;
            if ($isLogin != 0) {

                $admin = Mage::getModel('Admin/User')->load($isLogin);
                $role_id = $admin->getRoleId();
                $this->getSession()->set('role_id', $role_id);
                $role = Mage::getModel('Admin/Role')->load($role_id);
                $this->_roleAllowedAction = $role->getPermissions();
            } else {
                $this->redirect('admin/account/login');
            }
        }
    }

    public function getLayout()
    {
        return Mage::getBlockSingleton('Core/Layout_Admin');
    }
}
?>