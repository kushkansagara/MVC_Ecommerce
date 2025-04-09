<?php


class Admin_Controller_Event_Index extends Core_Controller_Admin_Action
{

    public function newAction()
    {
        $layout = $this->getLayout();
        $new = $layout->createBlock('Admin/Event_Index_New')
            ->setTemplate('Admin/Event/index/new.phtml');
        $layout->getChild('content')->addChild('new', $new);
        $layout->toHtml();
    }
    public function listAction()
    {
        $layout = $this->getLayout();
        $list = $layout->createBlock('Admin/Event_Index_List');

        $layout->getChild('content')->addChild('list', $list);
        $layout->toHtml();
    }

    public function saveAction()
    {
        $admin_id = $this->getSession()->get('login');
        $data = $this->getRequest()->getParams();
        $event = Mage::getModel('ems/events')
            ->setData($data['ems_events'])
            ->setCreatedBy($admin_id)
            ->save();
        $this->redirect('admin/event_index/list');
    }
    public function deleteAction()
    {
        $id = $this->getRequest()->getQuery('id');
        $event = Mage::getModel('ems/events');
        $event->load($id);

        $event->delete();
        $this->redirect('admin/event_index/list');
    }
    public function usersAction()
    {
        $layout = $this->getLayout();
        $list = $layout->createBlock('Admin/Event_Index_Users');

        $layout->getChild('content')->addChild('list', $list);

        $layout->getChild('head')->addJs('Admin/event/index/users.js');
        $layout->toHtml();
    }
    public function changestatusAction()
    {
        $data = $this->getRequest()->getParams();
        $user = Mage::getModel('ems/registrations')
            ->setId($data['id'])
            ->setStatus($data['status'])
            ->setUpdatedAt(date('Y-m-d H:i:s'))
            ->save();
        $this->redirect('admin/event_index/users?id=' . $data['eid']);

    }
}