<?php
class Admin_Block_Event_Index_List extends Admin_Block_Widget_Grid
{
    protected $_collection;
    public function __construct()
    {
        $this->addColumn('id', [
            'render' => 'number',
            'lable' => 'event id',
            'data_index' => 'id',
            'filter' => 'number',
        ]);
        $this->addColumn('title', [
            'render' => 'text',
            'lable' => 'name',
            'data_index' => 'title',
            'filter' => 'text',
        ]);
        $this->addColumn('description', [
            'render' => 'text',
            'lable' => 'description',
            'data_index' => 'description',
            'filter' => 'text',
        ]);
        $this->addColumn('date', [
            'render' => 'date',
            'lable' => 'date',
            'data_index' => 'date',
            'filter' => 'text',
        ]);
        $this->addColumn('location', [
            'render' => 'text',
            'lable' => 'location',
            'data_index' => 'location',
            'filter' => 'text',
        ]);
        $this->addColumn('capacity', [
            'render' => 'number',
            'lable' => 'capacity',
            'data_index' => 'capacity',
            'filter' => 'number',
        ]);
        $this->addColumn('created_by', [
            'render' => 'number',
            'lable' => 'admin id',
            'data_index' => 'created_by',
            'filter' => 'number',
        ]);

        $this->addColumn('total count', [
            'render' => 'total',
            'lable' => 'total count',
            'callback' => 'totalCount',
            // 'filter' => 'number',
        ]);
        $this->addColumn('edit', [
            'render' => 'link',
            'lable' => 'edit',
            'action' => 'new',
            'callback' => 'getEditUrl',
            'class' => 'fa fa-edit'

        ]);
        $this->addColumn('delete', [
            'render' => 'link',
            'lable' => 'delete',
            'action' => 'delete',
            'callback' => 'getDeleteUrl',
            'class' => 'fa fa-trash text-danger'

        ]);


        $get_data = $this->getRequest()->getQuery();
        $category = Mage::getModel('ems/events')->getCollection();
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

        $this->setCollection($category);

        parent::__construct();
    }

    public function getEditUrl($data)
    {
        return $this->getUrl('*/*/new') . '?id=' . $data->getData()['id'];
    }
    public function getDeleteUrl($data)
    {
        return $this->getUrl('*/*/delete') . '?id=' . $data->getData()['id'];
    }
    public function totalCount($data)
    {
        $event_id = $data->getData()['id'];
        $count = Mage::getModel('ems/registrations')->getCollection()->addFieldToFilter('event_id', $event_id)->getData();
        return count($count);
    }
}