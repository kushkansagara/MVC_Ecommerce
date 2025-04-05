<?php

class Admin_Block_Widget_Grid_Import_Csv extends Admin_Block_Widget_Grid
{
    public function __construct()
    {
        $this->setTemplate('admin/widget/grid/import/csv.phtml');
    }

    // public function getCsvFile()
    // {
    //     $export = $this->getRequest()->getQuery('export');
    //     if ($export) {
    //         $datas = $this->getParent()->getCollection()->getData();
    //         header('Content-Type: text/csv; charset=utf-8');
    //         header('Content-Disposition: attachment; filename=data.csv');
    //         $output = fopen("php://output", "w");
    //         $key = array_keys($datas[0]->getData());
    //         fputcsv($output, $key);
    //         foreach ($datas as $data) {
    //             fputcsv($output, $data->getData());
    //         }
    //         fclose($output);
    //         exit;
    //     }
    // }

}
?>