<?php

class Ems_Controller_Events extends Core_Controller_Customer_Action
{
    public function listAction()
    {
        $layout = Mage::getBlock('Core/Layout');
        $list = $layout->createBlock('Ems/Events_List');
        $layout->getChild('content')->addChild('list', $list);

        $layout->toHtml();
    }
    public function registerAction()
    {
        $id = $this->getRequest()->getQuery('id');
        $customer_id = $this->getSession()->get('customer_id');

        $register = Mage::getModel('ems/registrations')
            ->setUserId($customer_id)
            ->setEventId($id)
            ->save();

        $this->redirect('ems/events/list');
    }

}

?>