<?php

class Admin_Block_Ticket_Index_View extends Core_Block_Template
{
    protected $_arr = [];
    protected $_level;
    protected $_rows = [];
    protected $_rowspans = [];
    public function __construct()
    {
        $this->setTemplate('admin/ticket/index/view.phtml');
    }

    public function getData()
    {
        return mage::getModel('ticket/ticket')
            ->load($this->getId());
    }
    public function getId()
    {
        return $this->getRequest()->getQuery('id');
    }
    public function getComments()
    {
        $all = $this->getRequest()->getQuery('all');
        $l = $this->getRequest()->getQuery('level');
        $collection = Mage::getModel('ticket/comment')
            ->getCollection()
            ->addFieldToFilter('ticket_id', $this->getId());
        if ($l) {
            $this->_level = $this->getMaxlevel() - $this->getRequest()->getQuery('level') + 1;
            $collection->addFieldToFilter('level', ['>=' => $this->_level]);
        }

        if ($all) {
            return $collection;
        } else {
            $collection->addFieldToFilter('is_active', 1);
            return $collection;
        }
    }


    public function dataArray($level = null, $id = null)
    {
        if ($level != null) {
            $datas = $this->getComments()->addFieldToFilter('level', $level)->getData();
        } else {
            $datas = $this->getComments()->addFieldToFilter('parent_id', $id)->getData();
        }

        if (!$datas) {
            $this->_arr[$id] = [];
            return;
        }
        foreach ($datas as $d) {
            $this->_arr[is_null($id) ? 0 : $id][$d->getCommentId()] = $d->getComment();
            $this->dataArray(null, $d->getCommentId());
        }
        return $this->_arr;
    }


    public function getMaxlevel()
    {
        $sql = Mage::getModel('ticket/comment')
            ->getCollection()
            ->addFieldToFilter('ticket_id', $this->getId())
            ->select(['MAX(level)' => 'level'])
            ->limit('1', '1')

            ->getFirstItem()
            ->getLevel();


        return $sql;
    }
    public function getName()
    {
        return Mage::getModel('ticket/ticket')
            ->load($this->getId());
    }

    function buildTree($tableArray, $parentId = 0)
    {
        $tree = [];
        if (isset($tableArray[$parentId])) {
            foreach ($tableArray[$parentId] as $key => $val) {
                $node = [
                    'id' => $key,
                    'label' => $val,
                    'children' => $this->buildTree($tableArray, $key)
                ];
                $tree[] = $node;
            }
        }

        return $tree;
    }


    function getPaths($tree, $path = [])
    {
        foreach ($tree as $t) {
            $currpath = array_merge($path, [$t['id']]);
            if (empty($t['children'])) {
                $this->_rows[] = $currpath;
            } else {
                $countBefore = count($this->_rows);
                $this->getPaths($t['children'], $currpath);
                $temp = count($this->_rows) - $countBefore;
                $level = count($path);
                $this->_rowspans[$level][$t['id']] = $temp;
            }
        }
    }

    public function getCommentTitle($id)
    {
        return Mage::getModel('ticket/comment')
            ->load($id);

    }

    function render($tree, $ticketName)
    {
        $this->_rows = [];
        $this->_rowspans = [];
        $this->getPaths($tree);

        Mage::log($this->_rowspans);


        if (!empty($this->_rows)) {
            $last = !empty($this->_rowspans) ? max(array_keys($this->_rowspans)) + 1 : 0;
            $totalRows = count($this->_rows);

            $html = '<table border="1">';
            $html .= '<tr>';
            $html .= '<td rowspan="' . $totalRows . '">' . $ticketName . '</td>';

            $printed = [];
            foreach ($this->_rows[0] as $key => $val) {
                $span = $this->_rowspans[$key][$val] ?? 1;
                $comment = $this->getCommentTitle($val);
                $html .= '<td  data-level=' . $comment->getLevel() . ' ' . ($comment->getIsActive() == 0 ? 'style="background-color: green;"' : '') . ' rowspan="' . $span . '" data-node-complete="' . $val . '">' . $comment->getComment();

                if ($key == $last && $comment->getIsActive() == 1) {
                    $html .= '<button value="' . $val . '" onclick="completebtn(this)">Complete</button></td>';
                    $html .= '<td data-node-id="' . $val . '" data-level=' . $comment->getLevel() . '><button onclick="openTextbox()"> add comment </button></td>';
                }
                $printed[$key][$val] = true;
            }

            $html .= '</tr>';

            for ($i = 1; $i < $totalRows; $i++) {
                $html .= '<tr>';
                foreach ($this->_rows[$i] as $key => $val) {
                    if (!isset($printed[$key][$val])) {
                        $span = $this->_rowspans[$key][$val] ?? 1;
                        $comment = $this->getCommentTitle($val);
                        $html .= '<td ' . ($comment->getIsActive() == 0 ? 'style="background-color: green;"' : '') . ' rowspan="' . $span . '" data-node-complete="' . $val . '">' . $comment->getComment();

                        if ($key == $last && $comment->getIsActive() == 1) {
                            $html .= '<button value="' . $val . '" onclick="completebtn(this)">Complete</button></td>';
                            $html .= '<td data-node-id="' . $val . '" data-level=' . $comment->getLevel() . '><button onclick="openTextbox()"> add comment </button></td>';
                        }
                        $printed[$key][$val] = true;
                    }
                }
                $html .= '</tr>';
            }

            $html .= '</table>';
        } else {
            $html = '<table border="1">';
            $html .= '<tr>';
            $html .= '<td>' . $ticketName . '</td>';
            $html .= '<td data-node-id="0"><button onclick="openTextbox()"> add comment </button></td>';
            $html .= '<tr>';
            $html .= '<table>';
        }

        return $html;
    }

}
?>