<?php
class Admin_Block_Event_Index_Users extends Core_Block_Template
{
    public function __construct()
    {
        $this->setTemplate('Admin/Event/index/users.phtml');
    }

    public function getUsers()
    {
        $id = $this->getRequest()->getQuery('id');
        $users = Mage::getModel('ems/registrations')->getCollection()
            ->addFieldToFilter('event_id', $id);
        return $users->getData();
    }
    public function getEventName()
    {
        $id = $this->getRequest()->getQuery('id');
        $event = Mage::getModel('ems/events')->load($id);
        return $event;
    }
    public function totalUser()
    {
        $id = $this->getRequest()->getQuery('id');
        $users = Mage::getModel('ems/registrations')->getCollection()
            ->addFieldToFilter('event_id', $id);
        return count($users->getData());
    }
    public function PendingUser()
    {
        $id = $this->getRequest()->getQuery('id');
        $users = Mage::getModel('ems/registrations')->getCollection()
            ->addFieldToFilter('status', 'Pending')
            ->addFieldToFilter('event_id', $id);
        return count($users->getData());
    }
    public function ApprovedUser()
    {
        $id = $this->getRequest()->getQuery('id');
        $users = Mage::getModel('ems/registrations')->getCollection()
            ->addFieldToFilter('status', 'Approved')
            ->addFieldToFilter('event_id', $id);
        return count($users->getData());
    }
    public function RejectedUser()
    {
        $id = $this->getRequest()->getQuery('id');
        $users = Mage::getModel('ems/registrations')->getCollection()
            ->addFieldToFilter('status', 'Rejected')
            ->addFieldToFilter('event_id', $id);
        return count($users->getData());
    }
}