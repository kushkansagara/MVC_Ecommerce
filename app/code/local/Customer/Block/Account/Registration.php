<?php

class Customer_Block_Account_registration extends Core_Block_Template
{
    public function getHtml($field, $data)
    {
        $field = ucfirst(strtolower($field));
        $classname = sprintf("Core_Block_Html_Elements_%s", $field);
        $element = new $classname($data);
        return $element->render();
    }

    public function getCustomer()
    {
        $id = Mage::getSingleton('core/session')->get('customer_id');
        return Mage::getModel('customer/account')->load($id);
    }
}
?>