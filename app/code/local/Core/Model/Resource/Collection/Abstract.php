<?php

class core_Model_Resource_Collection_Abstract
{
    protected $_resource;
    protected $_select;
    protected $_model;

    public function setResource($resource)
    {
        $this->_resource = $resource;
        // echo "<pre>";
        // print_r($this);
        return $this;
    }

    public function setModel($model)
    {

        $this->_model = $model;
        // echo "<pre>";
        // print_r($this);
        return $this;
    }

    public function select()
    {
        $this->_select['FROM'] = $this->_resource->getTableName();
        $this->_select['COLUMNS'] = ['*'];
        // echo "<pre>";
        // print_r($this);
    }

    public function getData()
    {
        // $sql = sprintf("SELECT %s FROM %s", implode(",", $this->_select['COLUMNS']), $this->_select['FROM']);
        $data = $this->_resource->getAdapter()->fetchAll($this->prepareQuery());

        // echo "<pre>";
        // print_r($data);
        // print_r($this);
        foreach ($data as &$_data) {
            // print_r($this->_model);
            $_model = new $this->_model;
            $_data = $_model->setData($_data);
            // print_r($this->_model);
            // print_r($_data);
        }
        // print_r($data);

        return $data;

        // print_r($a);
    }

    public function addFieldToFilter($field, $condition)
    {
        if (!is_array($condition)) {
            $condition = ['eq' => $condition];
        }
        $this->_select['WHERE'][$field][] = $condition;
        return $this;
    }

    public function prepareQuery()
    {
        $query = sprintf("SELECT %s FROM %s", implode(',', $this->_select['COLUMNS']), $this->_select['FROM']);

        if (isset($this->_select['JOIN_LEFT'])) {
            $joinsql = "";
            foreach ($this->_select['JOIN_LEFT'] as $joinLeft) {
                $joinsql .= sprintf(" LEFT JOIN  %s ON %s ", $joinLeft['tablename'], $joinLeft['condition']);
            }
            $query = $query . " " . $joinsql;
        }
        if (isset($this->_select['WHERE'])) {
            $wheresql = "";
            $count = count($this->_select['WHERE']);
            $conditions = [];
            foreach ($this->_select['WHERE'] as $field => $value) {
                foreach ($value as $_value) {
                    $conditions[] = $this->where($field, $_value);
                }
            }

            $wheresql .= " WHERE " . implode(' AND ', $conditions);

            $query = $query . " " . $wheresql;

        }
        if (isset($this->_select['GROUPBY'])) {
            $groupBySql = "GROUP BY " . implode(', ', $this->_select['GROUPBY']);
            $query .= " " . $groupBySql;
        }
        if (isset($this->_select['HAVING'])) {
            $havingsql = "";
            $count = count($this->_select['HAVING']);
            $conditions = [];
            foreach ($this->_select['HAVING'] as $field => $value) {
                foreach ($value as $_value) {
                    $conditions[] = $this->where($field, $_value);
                }
            }

            $havingsql .= " HAVING " . implode(' AND ', $conditions);

            $query = $query . " " . $havingsql;

        }
        if (isset($this->_select['ORDERBY'])) {
            $orderBySql = "ORDER BY " . implode(', ', $this->_select['ORDERBY']);
            $query .= " " . $orderBySql;
        }

        echo $query;
        die();
        return $query;
    }




    public function where($field, $value)
    {
        if (is_array($value)) {

            foreach ($value as $operator => $_value) {
                switch (strtoupper($operator)) {
                    case 'IN':
                    case 'NOT IN':

                        $_value = (is_array($_value)) ? $_value : [$_value];

                        foreach ($_value as $key => $val) {

                            $inarryvalues[] = (is_string($val)) ? "'{$val}'" : "{$val}";
                        }
                        $_value = implode(',', $inarryvalues);
                        $where = " {$field} {$operator} ({$_value}) ";
                        break;

                    case 'BETWEEN':
                    case 'NOT BETWEEN':
                        foreach ($value as $key => $val) {
                            if (is_array($val)) {
                                foreach ($val as $limits) {
                                    $betweenvalues[] = (is_string($limits)) ? "'{$limits}'" : "{$limits}";
                                }
                            } else {
                                $betweenvalues[] = (is_string($val)) ? "'{$val}'" : "{$val}";
                            }
                        }
                        $betweenvaluestring = implode(' AND ', $betweenvalues);
                        $where = " {$field} {$operator} {$betweenvaluestring}";
                        break;
                    case 'EQ':
                        $where = "{$field} = '{$_value}'";
                        break;

                    default:
                        $where = " {$field} {$operator} '{$_value}' ";
                        break;
                }
            }
        }
        return $where;
    }

    public function joinLeft($tableName, $condition, $columns)
    {
        $this->_select['JOIN_LEFT'][] = ['tablename' => $tableName, 'condition' => $condition, 'columns' => $columns];

        foreach ($columns as $alias => $columnName) {
            $this->_select['COLUMNS'][] = sprintf("%s.%s AS '%s'", $tableName, $columnName, $alias);
        }
        return $this;
    }

    // public function groupBy($columns)
    // {
    //     $this->_select["GROUPBY"][] = ['columns' => $columns];

    //     foreach ($columns as $columnName) {
    //         $this->_select['GROUPBY'][] = sprintf("%s", $columnName);
    //     }
    //     echo "<pre>";
    //     print_r($this);
    //     return $this;
    // }

    public function groupBy($columns)
    {
        foreach ($columns as $columnName) {
            $this->_select['GROUPBY'][] = sprintf("%s", $columnName);
        }
        echo "<pre>";
        print_r($this);
        return $this;
    }
    public function orderBy($columns)
    {
        foreach ($columns as $columnName) {
            $this->_select['ORDERBY'][] = sprintf("%s", $columnName);
        }
        echo "<pre>";
        print_r($this);
        return $this;
    }
    public function having($field, $condition)
    {
        if (!is_array($condition)) {
            $condition = ['eq' => $condition];
        }
        $this->_select['HAVING'][$field][] = $condition;
        return $this;
    }

}

?>