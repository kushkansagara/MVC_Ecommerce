<?php
class Admin_Block_Order extends Admin_Block_Widget_Grid
{
    protected $_collection;
    public function __construct()
    {
        $this->addColumn('order_id', [
            'render' => 'number',
            'lable' => 'order id',
            'data_index' => 'order_id',
            'filter' => 'number',

        ]);
        $this->addColumn('customer_id', [
            'render' => 'number',
            'lable' => 'customer id',
            'data_index' => 'customer_id',
            'filter' => 'number',
        ]);
        $this->addColumn('email', [
            'render' => 'text',
            'lable' => 'email',
            'data_index' => 'email',
            'filter' => 'text',

        ]);
        $this->addColumn('total amount', [
            'render' => 'number',
            'lable' => 'total amount',
            'data_index' => 'total_amount',
            'filter' => 'number',
        ]);
        $this->addColumn('order status', [
            'render' => 'dropdown',
            'lable' => 'order status',
            'data_index' => 'order_status',
            'filter' => 'dropdown',
            'options' => ['pending', 'processing', 'shipping', 'delivered', 'cancelled'],
        ]);
        $this->addColumn('view', [
            'render' => 'link',
            'lable' => 'view order',
            'action' => 'view',
            'callback' => 'getOrderUrl',
            'class' => 'fa fa-eye'
            // 'filter' => 'text',

        ]);
        $this->addColumn('delete', [
            'render' => 'link',
            'lable' => 'delete',
            'action' => 'delete',
            'callback' => 'getDeleteUrl',
            'class' => 'fa fa-trash text-danger'
            // 'filter' => 'text',

        ]);
        $category = Mage::getModel('sales/order')
            ->getCollection();
        $this->setCollection($category);
        parent::__construct();
    }

    public function getOrderUrl($data)
    {
        return $this->getUrl('*/*/view') . '?id=' . $data->getData()['order_id'];
    }
    public function getDeleteUrl($data)
    {
        return $this->getUrl('*/*/delete') . '?id=' . $data->getData()['order_id'];
    }

    // public function init()
    // {
    //     $this->_collection = Mage::getModel('sales/order')
    //         ->getCollection();
    //     $this->getChild('toolbar')->prepareToolbar();
    // }
    // public function getOrderData()
    // {
    //     return $this->getCollection()->getData();
    // }
    // public function getCollection()
    // {
    //     return $this->_collection;
    // }
}
?>