<?php

class Admin_Controller_Customer_Index extends Core_Controller_Admin_Action
{
    public function newAction()
    {
        $layout = $this->getLayout();
        $save = $layout->createBlock('Admin/Customer_Index_Save')
            ->setTemplate('Admin/customer/index/save.phtml');
        $layout->getChild('content')->addChild('save', $save);

        $layout->toHtml();
    }
    public function listAction()
    {
        $layout = $this->getLayout();
        $list = $layout->createBlock('Admin/Customer_Index_List')
            ->setTemplate('Admin/customer/index/list.phtml');
        $layout->getChild('content')->addChild('list', $list);

        $layout->toHtml();

    }
    public function saveAction()
    {
        echo get_class() . "----" . __FUNCTION__;
        $layout = $this->getLayout();
        $save = $layout->createBlock('Admin/Customer_Index_Save')
            ->setTemplate('Admin/customer/index/save.phtml');
        $layout->getChild('content')->addChild('save', $save);

        $layout->toHtml();


    }
    public function deleteAction()
    {
        $layout = $this->getLayout();
        $delete = $layout->createBlock('Admin/Customer_Index_Delete')
            ->setTemplate('Admin/customer/index/delete.phtml');
        $layout->getChild('content')->addChild('delete', $delete);

        $layout->toHtml();
    }
}

?>