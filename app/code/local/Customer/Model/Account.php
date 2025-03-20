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
        // echo '<pre>';
        $data = $this->getData();
        // echo '</pre>';
        // die;
        $Customer_address = Mage::getModel('customer/account_address')
            ->getCollection()
            ->addFieldToFilter('customer_id', $this->getCustomerId())
            ->getData();

        if ($Customer_address) {
            $Customer_address[0]->data($this)
                ->save();
        } else {
            Mage::getModel('customer/account_address')
                ->setData($data)
                ->save();
        }
    }
}
?>