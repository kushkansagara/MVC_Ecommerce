<?php

class Admin_Controller_Account extends Core_Controller_Admin_Action
{
    protected $_allowedActions = [
        'login',
        'loginPost'
    ];
    public function loginAction()
    {
        // echo "Plase Login First";
        $layout = $this->getLayout();
        $new = $layout->createBlock('Admin/Account_Login')
            ->setTemplate('Admin/Account/login.phtml');

        $layout->getChild('content')->addChild('new', $new);

        $layout->toHtml();

    }

    public function loginPostAction()
    {
        $session = Mage::getSingleton('core/session');
        $params = $this->getRequest()->getParams();
        $admin = Mage::getSingleton('admin/user')->load($params['admin_user']['username'], 'username');
        if ($params['admin_user']['password'] == $admin->getPasswordHash() && !empty($params['admin_user']['username']) && !empty($params['admin_user']['password'])) {
            $session->set('login', $admin->getAdminId());
            header('Location:' . Mage::getBaseUrl() . 'admin/Product_Index/New');
        } else {
            echo "Wrong credentials";
            $session->remove('login');
        }
    }
}
?>