<?php
class Ems_Block_Events_List extends Core_Block_Template
{
    public function __construct()
    {
        $this->setTemplate('ems/events/list.phtml');
    }
    public function getUpcomingEvents()
    {
        $event = Mage::getModel('ems/events')
            ->getCollection()
            ->addFieldToFilter('date', ['>=' => date('Y-m-d')])
        ;
        //         ->getCollection()
        // ->joinLeft(
        //     ['registrations' => 'ems_registrations'],
        //     'main_table.id = registrations.event_id',
        //     ['uid' => 'user_id', 'status' => 'status']
        // )
        // ->addFieldToFilter('registrations.user_id', Mage::getModel('core/session')->get('customer_id'))
        // ->addFieldToFilter('main_table.date', ['>=' => date('Y-m-d')])
        return $event->getData();
    }

    public function getPast()
    {
        $event = Mage::getModel('ems/events')
            ->getCollection()
            ->joinInner(
                ['registrations' => 'ems_registrations'],
                'main_table.id = registrations.event_id',
                ['uid' => 'user_id', 'status' => 'status']
            )
            ->addFieldToFilter('registrations.user_id', Mage::getModel('core/session')->get('customer_id'))
            ->addFieldToFilter('registrations.status', ['IN' => ['Approved', 'Pending']]);
        ;
        return $event->getData();
    }
    public function getTotaluser($id)
    {
        $event = Mage::getModel('ems/registrations')
            ->getCollection()
            ->addFieldToFilter('event_id', $id)
            ->addFieldToFilter('status', ['IN' => ['Approved', 'Pending']]);
        ;
        return count($event->getData());
    }

    public function already($id)
    {
        $event = Mage::getModel('ems/registrations')
            ->getCollection()
            ->addFieldToFilter('event_id', $id)
            ->addFieldToFilter('user_id', Mage::getModel('core/session')->get('customer_id'))
        ;
        return count($event->getData());
    }
}
?>