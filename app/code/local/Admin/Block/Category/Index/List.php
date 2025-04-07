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
            // 'name' => 'category_id',

        ]);
        $this->addColumn('name', [
            'render' => 'text',
            'lable' => 'name',
            'data_index' => 'name',
            'filter' => 'text',
            // 'name' => 'catalog_category[name]'

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

        ]);
        $this->addColumn('delete', [
            'render' => 'link',
            'lable' => 'delete',
            'action' => 'delete',
            'callback' => 'getDeleteUrl',
            'class' => 'fa fa-trash text-danger'

        ]);
        $get_data = $this->getRequest()->getQuery();
        $category = Mage::getModel('catalog/category')->getCollection();
        if (!empty($get_data['category_id-from']) && !empty($get_data['category_id-to'])) {
            $category->addFieldToFilter('category_id', [
                'BETWEEN' => [$get_data['category_id-from'], $get_data['category_id-to']]
            ]);
        }
        if (!empty($get_data['name'])) {
            $category->addFieldToFilter('name', ['like' => '%' . $get_data['name'] . '%']);
        }

        if (!empty($get_data['description'])) {
            $category->addFieldToFilter('description', ['like' => '%' . $get_data['description'] . '%']);
        }

        // Mage::log($category->getData());
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