<?php

class core_Model_Resource_Abstract
{
    protected $_tableName = "";
    protected $_primaryKey = "";

    public function __construct()
    {
        $this->_construct();
    }
    public function _construct()
    {
        return $this;
    }
    public function init($tableName, $primaryKey)
    {
        $this->_tableName = $tableName;
        $this->_primaryKey = $primaryKey;
    }

    public function getTableName()
    {
        // print_r($this);
        return $this->_tableName;
    }

    public function getAdapter()
    {
        return new Core_Model_DB_Adapter();
    }
    public function load($value)
    {
        $sql = "SELECT * FROM {$this->_tableName} WHERE {$this->_primaryKey} = $value LIMIT 1";

        // print_r($this->getAdapter()->fetchRow($sql));
        return $this->getAdapter()->fetchRow($sql);
        // print_r($data);

        // return [];
    }
    public function save($model)
    {
        // print_r($model);
        // die();
        $data = $model->getData();
        // $oldimage = $data['image'];
        echo "<pre>";
        print_r($data);


        $primaryId = 0;
        if (isset($data[$this->_primaryKey]) && $data[$this->_primaryKey]) {
            $primaryId = $data[$this->_primaryKey];
        }

        // if (isset($_FILES['catlog_product']['name']['image']) && $_FILES['catlog_product']['error']['image'] == 0) {
        //     $uploadDir = Mage::getBaseDir() . "/media/product/";

        //     if (!file_exists($uploadDir)) {
        //         mkdir($uploadDir, 0777, true);
        //     }

        //     $fileName = time() . "_" . basename($_FILES['catlog_product']['name']['image']);
        //     $uploadFilePath = $uploadDir . $fileName;
        //     $tmpFilePath = $_FILES['catlog_product']['tmp_name']['image'];

        //     if (move_uploaded_file($tmpFilePath, $uploadFilePath)) {
        //         $data['image'] = "media/product/" . $fileName;
        //     }
        // }

        // $newimage = $data['image'];

        print_r($data);
        // die();
        if ($primaryId) {

            // if ($oldimage != $newimage) {
            //     unlink($oldimage);
            //     echo "Image deleted successfully";
            // }
            $columns = [];
            unset($data[$this->_primaryKey]);
            foreach ($data as $key => $value) {
                $value = ($value !== null) ? $value : '';
                $columns[] = sprintf("`{$key}` = '%s'", addslashes($value));
            }
            $columns = implode(",", $columns);

            $sql = sprintf(
                "UPDATE %s SET %s WHERE %s = %d",
                $this->_tableName,
                $columns,
                $this->_primaryKey,
                $primaryId
            );

            return $this->getAdapter()->query($sql);
            // echo $sql;
            // echo "update";
        } else {
            $columns = [];
            $values = [];
            foreach ($data as $key => $value) {
                // $value = ($value !== null) ? $value : '';
                // $columns[] = sprintf("`{$key}` = '%s'", addslashes($value));
                $columns[] = $key;
                $values[] = $value;
            }
            $columns = implode("`,`", $columns);
            $values = implode("','", $values);


            $sql = sprintf(
                "INSERT INTO %s (`%s`) VALUES ('%s')",
                $this->_tableName,
                $columns,
                $values
            );
            echo "</pre>";
            // echo $sql;
            // die();
            $id = $this->getAdapter()->insert($sql);
            print_r($id);

            $model->load($id);
            // echo $sql;
            echo "<pre>";
            // print_r($data);
            // echo "Insert";
        }
        echo get_class($model);
    }

    public function delete($model)
    {
        print_r($model);


        $data = $model->getData();
        // $image = $data['image'];
        // print_r($data);
        $primaryId = 0;
        if (isset($data[$this->_primaryKey]) && $data[$this->_primaryKey]) {
            $primaryId = $data[$this->_primaryKey];
        }

        // if ($primaryId) {
        $sql = sprintf(
            "DELETE FROM %s WHERE %s = %d",
            $this->_tableName,
            $this->_primaryKey,
            $primaryId
        );
        // unlink($image);
        // echo $sql;
        // return $this->getAdapter()->query($sql);
        // print_r($model);
        if ($this->getAdapter()->query($sql)) {
            $model->setData(null);
        }
        // }

    }
}
?>