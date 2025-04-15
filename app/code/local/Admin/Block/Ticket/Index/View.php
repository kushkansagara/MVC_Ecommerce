<?php

class Admin_Block_Ticket_Index_View extends Core_Block_Template
{
    protected $_arr = [];
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
        return Mage::getModel('ticket/comment')
            ->getCollection()
            ->addFieldToFilter('ticket_id', $this->getId());
        // ->orderBy(['node_id']);
    }
    public function dataArray($id = null)
    {
        $data = $this->getComments()->addFieldToFilter('parent_id', $id)->getData();
        if (!$data) {
            $this->_arr[$id] = [];
            return;
        }
        foreach ($data as $d) {
            $this->_arr[is_null($id) ? 0 : $id][$d->getCommentId()] = $d->getComment();
            $this->dataArray($d->getCommentId());
        }
        return $this->_arr;
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
                    'children' => $this->buildTree($tableArray, $key)
                ];
                $tree[] = $node;
            }
        }
        return $tree;
    }

    function getPaths($tree, $path = [], &$rows = [], &$rowspans = [])
    {
        foreach ($tree as $t) {
            $currpath = array_merge($path, [$t['id']]);
            if (empty($t['children'])) {
                $rows[] = $currpath;
            } else {
                $countBefore = count($rows);
                $this->getPaths($t['children'], $currpath, $rows, $rowspans);
                $temp = count($rows) - $countBefore;
                $level = count($path);
                $rowspans[$level][$t['id']] = $temp;
            }
        }
    }

    public function getCommentTitle($id)
    {
        return Mage::getModel('ticket/comment')
            ->load($id)
            ->getComment();

    }

    function render($tree, $ticketName)
    {
        $rows = [];
        $rowspans = [];
        $this->getPaths($tree, [], $rows, $rowspans);
        if (!empty($rows)) {
            if (!empty($rowspans)) {
                $last = max(array_keys($rowspans)) + 1;
            } else {
                $last = 0;
            }
            $totalRows = count($rows);

            $html = '<table border="1">';
            $html .= '<tr>';
            $html .= '<td rowspan="' . $totalRows . '">';
            $html .= "{$ticketName}</td>";
            foreach ($rows[0] as $key => $val) {
                $span = isset($rowspans[$key][$val]) ? $rowspans[$key][$val] : 1;
                $html .= '<td rowspan="' . $span . '">' . $this->getCommentTitle($val);
                if ($key == $last) {
                    $html .= '<td data-node-id="' . $val . '"><button onclick="openTextbox()"> add comment </button></td>';
                }
                $html .= '</td>';
                $printed[$key][$val] = true;
            }
            $html .= '</tr>';

            for ($i = 1; $i < $totalRows; $i++) {
                $html .= '<tr>';
                foreach ($rows[$i] as $key => $val) {
                    if (!isset($printed[$key][$val])) {
                        $span = isset($rowspans[$key][$val]) ? $rowspans[$key][$val] : 1;
                        $html .= '<td rowspan="' . $span . '">' . $this->getCommentTitle($val);
                        if ($key == $last) {
                            $html .= '<td data-node-id="' . $val . '"><button onclick="openTextbox()"> add comment </button></td>';

                        }
                        '</td>';
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