<?php

class Admin_Block_Widget_Grid extends Core_Block_Template
{
    protected $_collection;
    protected $_columns = [];

    public function __construct()
    {
        $this->_template = 'admin/widget/grid.phtml';
        $toolbar = Mage::getBlock('Admin/widget_Grid_Toolbar');
        $this->addChild('toolbar', $toolbar);
        $csv = Mage::getBlock('Admin/widget_Grid_Export_Csv');
        $this->addChild('csv', $csv);
        $this->init();
    }
    public function init()
    {
        // $this->_collection = $this->getCollection();
        $this->getChild('toolbar')->prepareToolbar();
        $this->getChild('csv')->getCsvFile();
    }

    public function addColumn($name, $data)
    {
        $columnBlock = Mage::getBlock("Admin/Widget_Grid_Column_{$data['render']}");

        $columnBlock->setData($data);
        $columnBlock->setBlock($this);
        $this->_columns[$name] = $columnBlock;
    }

    public function setCollection($coll)
    {
        $this->_collection = $coll;
    }
    public function getCollection()
    {
        return $this->_collection;
    }
    // public function renderFilter($data)
    // {
    //     if (!empty($data['filter'])) {
    //         $filter = $data['filter'];
    //         $filterBlock = Mage::getBlock("Admin/Widget_Grid_Filter_{$filter}");
    //         $filterBlock->setArray($data);
    //         $filterBlock->toHtml();
    //     }
    // }
    public function getValue($data)
    {
        echo $data;
    }

    public function renderColumn($data, $id = '')
    {
        $data['id'] = $id;
        $render = $data['render'];
        $columnBlock = Mage::getBlockSingleton("Admin/Widget_Grid_Column_{$render}");
        $columnBlock->setColumnValue($data);
        $columnBlock->toHtml();
    }

}
?>