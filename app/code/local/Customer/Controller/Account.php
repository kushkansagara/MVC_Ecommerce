<?php
class Customer_Controller_Account extends Core_Controller_Front_Action
{
    public function registrationAction()
    {
        $layout = Mage::getBlockSingleton('Core/Layout');
        $registration = $layout->createBlock('Customer/Account_registration')
            ->setTemplate('customer/account/registration.phtml');
        $layout->getChild('content')->addChild('list', $registration);
        $layout->toHtml();
    }

    public function saveAction()
    {
        $params = $this->getRequest()->getParams();
        $params['customer_account']['password_hash'] = hash('sha256', $params['customer_account']['password_hash']);

        $CustomerData = $params['customer_account'];
        $CustomerAccount = Mage::getModel('customer/account')
            ->setData($CustomerData);
        $CustomerAccount->save();
        $this->redirect('admin/prod uct_index/list');

    }
    public function loginAction()
    {
        $layout = Mage::getBlockSingleton('Core/Layout');
        $login = $layout->createBlock('Customer/Account_login')
            ->setTemplate('customer/account/login.phtml');
        $layout->getChild('content')->addChild('list', $login);
        $layout->toHtml();
    }
    public function loginPostAction()
    {
        $params = $this->getRequest()->getParams();
        $session = Mage::getSingleton('core/session');

        $customer = Mage::getSingleton('customer/account')
            ->load($params['customer_login']['email'], 'email');

        $current_pass = hash('sha256', $params['customer_login']['password']);

        if ($current_pass === $customer->getPasswordHash()) {
            $session->set('customer_id', $customer->getCustomerId());
            $this->redirect('');
        } else {
            $this->redirect('customer/account/login');
        }

    }
    public function logoutAction()
    {

    }
    public function forgotAction()
    {
        $layout = Mage::getBlockSingleton('Core/Layout');
        $forgot = $layout->createBlock('Customer/Account_forgot')
            ->setTemplate('customer/account/forgot.phtml');
        $layout->getChild('content')->addChild('list', $forgot);
        $layout->toHtml();
    }
    public function changeAction()
    {

    }
    public function dashboardAction()
    {
        $layout = Mage::getBlockSingleton('Core/Layout');
        $dashboard = $layout->createBlock('Customer/Account_dashboard')
            ->setTemplate('customer/account/dashboard.phtml');
        $layout->getChild('content')->addChild('list', $dashboard);
        $layout->toHtml();
    }



}
?>