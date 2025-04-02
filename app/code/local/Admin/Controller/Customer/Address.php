<?php

class Admin_Controller_Customer_Address extends Core_Controller_Admin_Action
{
    public function newAction()
    {
        $layout = $this->getLayout();
        $save = $layout->createBlock('Admin/Customer_Address_Save')
            ->setTemplate('Admin/customer/address/save.phtml');
        $layout->getChild('content')->addChild('save', $save);

        $layout->toHtml();
    }
    public function listAction()
    {
        $layout = $this->getLayout();
        $list = $layout->createBlock('Admin/Customer_Address_List')
            ->setTemplate('Admin/customer/address/list.phtml');
        $layout->getChild('content')->addChild('list', $list);

        $layout->toHtml();

    }
    public function saveAction()
    {
        echo get_class() . "----" . __FUNCTION__;
        $layout = $this->getLayout();
        $save = $layout->createBlock('Admin/Customer_Address_Save')
            ->setTemplate('Admin/customer/address/save.phtml');
        $layout->getChild('content')->addChild('save', $save);

        $layout->toHtml();


    }
    public function deleteAction()
    {
        $layout = $this->getLayout();
        $delete = $layout->createBlock('Admin/Customer_Address_Delete')
            ->setTemplate('Admin/customer/address/delete.phtml');
        $layout->getChild('content')->addChild('delete', $delete);

        $layout->toHtml();
    }

}

?>