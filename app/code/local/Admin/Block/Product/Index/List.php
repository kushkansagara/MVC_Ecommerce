<?php
class Admin_Block_Product_Index_List extends Admin_Block_Widget_Grid
{
    protected $_result;
    protected $_collection;
    public $catData;
    public function __construct()
    {
        $this->addColumn('product_id', [
            'render' => 'number',
            'lable' => 'product id',
            'data_index' => 'product_id',
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
        $this->addColumn('sku', [
            'render' => 'text',
            'lable' => 'sku',
            // 'action' => 'n',
            'data_index' => 'sku',
            // 'class' => 'fa fa-edit'
            'filter' => 'text',

        ]);
        $this->addColumn('price', [
            'render' => 'number',
            'lable' => 'price',
            // 'action' => '',
            'data_index' => 'price',
            // 'class' => 'fa fa-trash text-danger'
            'filter' => 'number',

        ]);
        $this->addColumn('stock_quantity', [
            'render' => 'number',
            'lable' => 'stock quantity',
            // 'action' => '',
            'data_index' => 'stock_quantity',
            // 'class' => 'fa fa-trash text-danger'
            'filter' => 'number',

        ]);
        $this->addColumn('category_id', [
            'render' => 'number',
            'lable' => 'category id',
            // 'action' => '',
            'data_index' => 'stock_quantity',
            // 'class' => 'fa fa-trash text-danger'
            'filter' => 'number',

        ]);
        $this->addColumn('warranty', [
            'render' => 'text',
            'lable' => 'warranty',
            // 'action' => '',
            'data_index' => 'stock_quantity',
            // 'class' => 'fa fa-trash text-danger'
            'filter' => 'text',

        ]);
        $this->addColumn('color', [
            'render' => 'text',
            'lable' => 'color',
            // 'action' => '',
            'data_index' => 'color',
            // 'class' => 'fa fa-trash text-danger'
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

        ]);

        $category = Mage::getSingleton('catalog/filter')
            ->getProductionCollection()
            ->addAttributeToSelect(["warranty", "color"]);
        $this->setCollection($category);
        parent::__construct();

    }
    public function getEditUrl($data)
    {
        return $this->getUrl('*/*/new') . '?id=' . $data->getData()['product_id'];
    }
    public function getDeleteUrl($data)
    {
        return $this->getUrl('*/*/delete') . '?id=' . $data->getData()['product_id'];
    }
}
?>