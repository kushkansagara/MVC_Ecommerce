<?php

class Admin_Block_Export_Csv extends Core_Block_Template
{
    // protected $_limit = 2;
    // protected $_page = 1;
    // protected $_collection2;
    public function __construct()
    {
        $this->setTemplate('admin/export/csv.phtml');
    }

    public function getCsvFile2()
    {
        $export = $this->getRequest()->getQuery('export');
        if ($export) {
            $datas = $this->getParent()->getCollection()->getData();
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=data.csv');
            $output = fopen("php://output", "w");
            $key = array_keys($datas[0]->getData());
            fputcsv($output, $key);
            foreach ($datas as $data) {
                fputcsv($output, $data->getData());
            }
            fclose($output);
            exit;
        }
    }
}
?>