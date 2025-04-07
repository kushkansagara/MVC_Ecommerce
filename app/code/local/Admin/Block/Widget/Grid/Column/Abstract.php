<?php

class Admin_Block_Widget_Grid_Column_Abstract
{
    protected $_data;
    protected $_object;
    protected $_row;
    public function render()
    {
        return "<span>{$this->getValue()}</span>";
    }
    public function getValue()
    {
        return $this->_row->{$this->_data['data_index']};
    }
    public function setRow($row)
    {
        $this->_row = $row;
    }
    public function setData($data)
    {
        $this->_data = $data;
        return $this;
    }
    public function getData()
    {
        return $this->_data;
    }
    public function getRow()
    {
        return $this->_row;
    }

    public function getFilter()
    {
        if (!empty($this->getData()['filter'])) {
            $filter = $this->getData()['filter'];
            return Mage::getBlock("Admin/Widget_Grid_Filter_{$filter}")
                ->setData($this->getData());
        } else {
            return Mage::getBlock("Admin/Widget_Grid_Filter_Abstract");
        }
    }

    public function setBlock($block)
    {
        $this->_object = $block;
    }
    public function getBlock()
    {
        return $this->_object;
    }


}
?>