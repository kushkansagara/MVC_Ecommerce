<?php
class Customer_Model_Account extends Core_Model_Abstract
{
    public function init()
    {
        $this->_resourceClassName = "Customer_Model_Resource_Account";
        $this->_collectionClassName = "Customer_Model_Resource_Account_Collection";
    }

    public function _afterSave()
    {
        $data = $this->getData();
        $Customer_address = Mage::getModel('customer/account_address')
            ->getCollection()
            ->addFieldToFilter('customer_id', $this->getCustomerId())
            ->getData();
        $session = Mage::getSingleton('core/session');
        if (empty($Customer_address)) {
            Mage::getModel('customer/account_address')
                ->setData($data)
                ->save();
        }
    }
}
?>