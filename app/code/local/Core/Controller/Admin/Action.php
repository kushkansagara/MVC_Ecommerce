<?php

class core_Controller_Admin_Action extends Core_Controller_Front_Action
{
    protected $_allowedActions = [];

    public function __construct()
    {
        $this->_init();
    }
    protected function _init()
    {

        $isLogin = $this->getSession()->get('login');
        // print_r($this);
        if (!in_array($this->getRequest()->getActionName(), $this->_allowedActions)) {
            if ($isLogin === 1) {

            } else {
                $this->redirect('admin/account/login');
            }
        }
    }
}
?>