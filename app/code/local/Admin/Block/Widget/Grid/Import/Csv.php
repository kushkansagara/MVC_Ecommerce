<?php

class Admin_Block_Widget_Grid_Import_Csv extends Admin_Block_Widget_Grid
{
    public function __construct()
    {
        $this->setTemplate('admin/widget/grid/import/csv.phtml');
    }
    public function importData()
    {
        if (isset($_POST["Import"])) {
            $filename = $_FILES["file"]["tmp_name"];
            if (pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION) != "csv") {
                echo "Please upload a CSV file.";
            } else {
                $file = fopen($filename, "r");
                $columns = fgetcsv($file, 1000, ",");
                while (($csvData = fgetcsv($file, 1000, ",")) !== false) {
                    $data = array_combine($columns, $csvData);
                    $product = Mage::getModel('catalog/product');
                    $product->setData($data)->save();
                }
            }
        }
    }
}
?>