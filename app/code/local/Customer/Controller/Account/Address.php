<?php
class Customer_Controller_Account_Address extends Core_Controller_Front_Action
{
    public function indexAction()
    {
        $layout = Mage::getBlockSingleton('Core/Layout');
        $index = $layout->createBlock('Customer/Account_Address_Index')
            ->setTemplate('customer/account/address/index.phtml');
        $layout->getChild('content')->addChild('list', $index);
        $layout->toHtml();
    }
    public function saveAction()
    {
        $params = $this->getRequest()->getParams();
        $session = Mage::getSingleton('core/session')->get('customer_id');
        $address = Mage::getModel('customer/account_address')
            ->setData($params['customer_account_address'])
            ->setCustomerId($session)
            ->save();
        $this->redirect('customer/account/dashboard');

    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getQuery('id');
        Mage::getModel('customer/account_address')->setAddressId($id)->delete();
        $this->redirect('customer/account/dashboard');
    }
}
?>