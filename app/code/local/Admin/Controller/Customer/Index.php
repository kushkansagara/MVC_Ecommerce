<?php

class Admin_Controller_Customer_Index
{
    public function newAction()
    {
        $layout = Mage::getBlock('Core/Layout');
        $save = $layout->createBlock('Admin/Customer_Index_Save')
            ->setTemplate('Admin/customer/index/save.phtml');
        $layout->getChild('content')->addChild('save', $save);

        $layout->toHtml();
    }
    public function listAction()
    {
        $layout = Mage::getBlock('Core/Layout');
        $list = $layout->createBlock('Admin/Customer_Index_List')
            ->setTemplate('Admin/customer/index/list.phtml');
        $layout->getChild('content')->addChild('list', $list);

        $layout->toHtml();

    }
    public function saveAction()
    {
        echo get_class() . "----" . __FUNCTION__;
        $layout = Mage::getBlock('Core/Layout');
        $save = $layout->createBlock('Admin/Customer_Index_Save')
            ->setTemplate('Admin/customer/index/save.phtml');
        $layout->getChild('content')->addChild('save', $save);

        $layout->toHtml();


    }
    public function deleteAction()
    {
        $layout = Mage::getBlock('Core/Layout');
        $delete = $layout->createBlock('Admin/Customer_Index_Delete')
            ->setTemplate('Admin/customer/index/delete.phtml');
        $layout->getChild('content')->addChild('delete', $delete);

        $layout->toHtml();
    }
}

?>