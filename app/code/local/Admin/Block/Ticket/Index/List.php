<?php

class Admin_Block_Ticket_Index_List extends Admin_Block_Widget_Grid
{
    protected $_collection;
    public function __construct()
    {
        $this->addColumn('ticket_id', [
            'render' => 'number',
            'lable' => 'ticket id',
            'data_index' => 'ticket_id',
            'filter' => 'number',
        ]);
        $this->addColumn('title', [
            'render' => 'text',
            'lable' => 'title',
            'data_index' => 'title',
            'filter' => 'text',
        ]);

        $this->addColumn('view', [
            'render' => 'link',
            'lable' => 'view',
            'action' => 'view',
            'callback' => 'getViewUrl',
            'class' => 'fa fa-eye'
        ]);
        // $this->addColumn('delete', [
        //     'render' => 'link',
        //     'lable' => 'delete',
        //     'action' => 'delete',
        //     'callback' => 'getDeleteUrl',
        //     'class' => 'fa fa-trash text-danger'

        // ]);
        $get_data = $this->getRequest()->getQuery();
        $category = Mage::getModel('ticket/ticket')->getCollection();
        // if (!empty($get_data['category_id-from']) && !empty($get_data['category_id-to'])) {
        //     $category->addFieldToFilter('category_id', [
        //         'BETWEEN' => [$get_data['category_id-from'], $get_data['category_id-to']]
        //     ]);
        // }
        // if (!empty($get_data['name'])) {
        //     $category->addFieldToFilter('name', ['like' => '%' . $get_data['name'] . '%']);
        // }

        // if (!empty($get_data['description'])) {
        //     $category->addFieldToFilter('description', ['like' => '%' . $get_data['description'] . '%']);
        // }

        // Mage::log($category->getData());
        $this->setCollection($category);

        parent::__construct();
    }

    public function getViewUrl($data)
    {
        return $this->getUrl('*/*/view') . '?id=' . $data->getData()['ticket_id'];
    }
    // public function getDeleteUrl($data)
    // {
    //     return $this->getUrl('*/*/delete') . '?id=' . $data->getData()['category_id'];
    // }

}

?>