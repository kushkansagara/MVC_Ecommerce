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
        return $this->_tableName;
    }

    public function getAdapter()
    {
        return new Core_Model_DB_Adapter();
    }
    public function load($value, $field = null)
    {
        $field = (is_null($field)) ? $this->_primaryKey : $field;

        $sql = "SELECT * FROM `{$this->_tableName}` WHERE $field = '$value' LIMIT 1";
        return $this->getAdapter()->fetchRow($sql);
    }
    public function save($model)
    {
        $dbColumns = $this->_getDbColumns();
        $data = $model->getData();

        $primaryId = 0;
        if (isset($data[$this->_primaryKey]) && $data[$this->_primaryKey]) {
            $primaryId = $data[$this->_primaryKey];
        }
        if ($primaryId) {
            $columns = [];
            unset($data[$this->_primaryKey]);
            foreach ($data as $key => $value) {
                if (in_array($key, $dbColumns)) {
                    $value = ($value !== null) ? $value : '';
                    $columns[] = sprintf("`{$key}` = '%s'", addslashes($value));
                }
            }
            $columns = implode(",", $columns);

            $sql = sprintf(
                "UPDATE `%s` SET %s WHERE %s = %d",
                $this->_tableName,
                $columns,
                $this->_primaryKey,
                $primaryId
            );
            //echo $sql;
            return $this->getAdapter()->query($sql);
        } else {
            $columns = [];
            $values = [];
            foreach ($data as $key => $value) {
                if (in_array($key, $dbColumns)) {
                    $values[] = $value;
                    $columns[] = $key;
                }

            }
            $columns = implode("`,`", $columns);
            $values = implode("','", $values);

            $sql = sprintf(
                "INSERT INTO `%s` (`%s`) VALUES ('%s')",
                $this->_tableName,
                $columns,
                $values
            );
            //echo $sql;
            $id = $this->getAdapter()->insert($sql);
            $model->{$this->_primaryKey} = $id;
        }
    }

    public function delete($model)
    {
        $data = $model->getData();
        $primaryId = 0;
        if (isset($data[$this->_primaryKey]) && $data[$this->_primaryKey]) {
            $primaryId = $data[$this->_primaryKey];
        }
        $sql = sprintf(
            "DELETE FROM %s WHERE %s = %d",
            $this->_tableName,
            $this->_primaryKey,
            $primaryId
        );
        if ($this->getAdapter()->query($sql)) {
            $model->setData(null);
        }
    }
    protected function _getDbColumns()
    {
        $sql = "SELECT COLUMN_NAME
                FROM INFORMATION_SCHEMA.COLUMNS
                WHERE TABLE_NAME = N'{$this->_tableName}'";
        $column_name = $this->getAdapter()->fetchCol($sql);
        return $column_name;
    }
}
?>