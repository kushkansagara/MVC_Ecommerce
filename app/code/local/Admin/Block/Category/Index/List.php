<?php
class Admin_Block_Category_Index_List extends Admin_Block_Widget_Grid
{
    protected $_collection;
    public function __construct()
    {
        $this->addColumn('category_id', [
            'render' => 'number',
            'lable' => 'category id',
            'data_index' => 'category_id',
            'filter' => 'number',

        ]);
        $this->addColumn('name', [
            'render' => 'text',
            'lable' => 'name',
            'data_index' => 'name',
            'filter' => 'text',

        ]);
        $this->addColumn('description', [
            'render' => 'text',
            'lable' => 'description',
            'data_index' => 'description',
            'filter' => 'text',

        ]);
        $this->addColumn('edit', [
            'render' => 'link',
            'lable' => 'edit',
            'action' => 'new',
            'callback' => 'getEditUrl',
            'class' => 'fa fa-edit'
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
        $category = Mage::getModel('catalog/category')->getCollection();
        $this->setCollection($category);
        parent::__construct();
    }

    public function getEditUrl($data)
    {
        return $this->getUrl('*/*/new') . '?id=' . $data->getData()['category_id'];
    }
    public function getDeleteUrl($data)
    {
        return $this->getUrl('*/*/delete') . '?id=' . $data->getData()['category_id'];
    }

}
?>