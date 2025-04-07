<?php

class core_Model_Resource_Collection_Abstract
{
    protected $_resource;
    protected $_select;
    protected $_model;

    public function setResource($resource)
    {
        $this->_resource = $resource;
        return $this;
    }

    public function setModel($model)
    {
        $this->_model = $model;
        return $this;
    }

    public function select($columns = ["*"])
    {
        $this->_select['FROM'] = ["main_table" => $this->_resource->getTableName()];
        $this->_select['COLUMNS'] = [];
        $columns = is_array($columns) ? $columns : [$columns];
        foreach ($columns as $aleas => $column) {
            // Mage::log($aleas);
            // Mage::log($column);
            if (is_integer($aleas)) {
                $this->_select['COLUMNS'][] = "main_table." . $column;
            } else {
                $this->_select['COLUMNS'][] = sprintf('%s as %s', $aleas, $column);
            }
        }
        return $this;
    }

    public function getData()
    {
        $data = $this->_resource->getAdapter()->fetchAll($this->prepareQuery());
        foreach ($data as &$_data) {
            $_model = new $this->_model;
            $_data = $_model->setData($_data);

        }
        return $data;
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
        $query = sprintf("SELECT %s FROM `%s` AS %s", implode(',', $this->_select['COLUMNS']), array_values($this->_select['FROM'])[0], array_keys($this->_select['FROM'])[0]);
        if (isset($this->_select['JOIN_LEFT'])) {
            $leftjoinsql = "";
            foreach ($this->_select["JOIN_LEFT"] as $joinLeft) {
                $leftjoinsql .= sprintf(
                    " LEFT JOIN %s AS %s ON %s ",
                    array_values($joinLeft['tablename'])[0],
                    array_keys($joinLeft['tablename'])[0],
                    $joinLeft['condition']
                );
            }
            $query .= " " . $leftjoinsql;
        }
        if (isset($this->_select['JOIN_RIGHT'])) {
            $rightJoinsql = "";
            foreach ($this->_select['JOIN_RIGHT'] as $joinRight) {
                $rightJoinsql .= sprintf(" RIGHT JOIN  %s ON %s ", $joinRight['tablename'], $joinRight['condition']);
            }
            $query = $query . " " . $rightJoinsql;
        }
        if (isset($this->_select['JOIN_INNER'])) {
            $innerJoin = "";

            foreach ($this->_select['JOIN_INNER'] as $joinInner) {
                $innerJoin .= sprintf(
                    " INNER JOIN %s AS %s ON %s ",
                    array_values($joinInner['tablename'])[0],
                    array_keys($joinInner['tablename'])[0],
                    $joinInner['condition']
                );
            }
            $query = $query . " " . $innerJoin;
        }
        if (isset($this->_select['JOIN_SELF'])) {
            $selfJoinSql = "";
            foreach ($this->_select['JOIN_SELF'] as $joinSelf) {
                $selfJoinSql .= sprintf(
                    " JOIN %s ON %s ",
                    $joinSelf['tablename'],
                    $joinSelf['condition']
                );
            }
            $query = $query . " " . $selfJoinSql;
        }
        if (isset($this->_select['JOIN_CROSS'])) {
            $crossJoinSql = "";
            foreach ($this->_select['JOIN_CROSS'] as $joinCross) {
                $crossJoinSql .= sprintf(" CROSS JOIN %s ", $joinCross['tablename']);
            }
            $query = $query . " " . $crossJoinSql;
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
        if (isset($this->_select['LIMIT'])) {
            $ordersql = sprintf("LIMIT %s", $this->_select['LIMIT']['limit']);
            if ($this->_select['LIMIT']['offset'] != '') {
                $ordersql .= " OFFSET " . $this->_select['LIMIT']['offset'];
            }
            $query = $query . " " . $ordersql;
        }
        // echo $query;
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

                            $inarryvalues[] = (is_string($val)) ? "'{$val}'" : "'{$val}'";
                        }
                        $_value = implode(",", $inarryvalues);
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
        $this->_select["JOIN_LEFT"][] = [
            "tablename" => $tableName,
            "condition" => $condition,
            "columns" => $columns
        ];

        foreach ($columns as $alias => $columnname) {
            $this->_select['COLUMNS'][] = sprintf(
                "%s.%s AS %s",
                array_keys($tableName)[0],
                $columnname,
                $alias
            );
        }
        return $this;
    }
    public function joinRight($tableName, $condition, $columns)
    {
        $this->_select['JOIN_RIGHT'][] = ['tablename' => $tableName, 'condition' => $condition, 'columns' => $columns];

        foreach ($columns as $alias => $columnName) {
            $this->_select['COLUMNS'][] = sprintf("%s.%s AS '%s'", $tableName, $columnName, $alias);
        }
        return $this;
    }
    public function joinInner($tableName, $condition, $columns)
    {

        $this->_select["JOIN_INNER"][] = [
            "tablename" => $tableName,
            "condition" => $condition,
            "columns" => $columns
        ];

        foreach ($columns as $alias => $columnname) {
            $this->_select['COLUMNS'][] = sprintf(
                "%s.%s AS %s",
                array_keys($tableName)[0],
                $columnname,
                $alias
            );
        }
        return $this;
    }

    public function joinSelf($tableAlias, $condition, $columns)
    {
        $tableName = $this->_select['FROM'];
        $this->_select['JOIN_SELF'][] = [
            'tablename' => sprintf("%s AS %s", $tableName, $tableAlias),
            'condition' => $condition,
            'columns' => $columns
        ];
        foreach ($columns as $alias => $columnName) {
            $this->_select['COLUMNS'][] = sprintf("%s.%s AS '%s'", $tableAlias, $columnName, $alias);
        }
        return $this;
    }

    public function crossJoin($tableName, $columns)
    {
        $this->_select['JOIN_CROSS'][] = [
            'tablename' => $tableName,
            'columns' => $columns
        ];

        foreach ($columns as $alias => $columnName) {
            $this->_select['COLUMNS'][] = sprintf("%s.%s AS '%s'", $tableName, $columnName, $alias);
        }
        return $this;
    }



    public function groupBy($columns)
    {
        foreach ($columns as $columnName) {
            $this->_select['GROUPBY'][] = sprintf("%s", $columnName);
        }
        ;
        return $this;
    }
    public function orderBy($columns)
    {
        foreach ($columns as $columnName) {
            $this->_select['ORDERBY'][] = sprintf("%s", $columnName);
        }
        ;
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
    public function limit($limit, $offset = "")
    {
        $this->_select["LIMIT"] = [
            'limit' => $limit,
            'offset' => ($offset - 1) * $limit
        ];
        return $this;
    }

    private function getTableAlias($table)
    {
        return array_keys($table)[0];
    }
    private function getTablename($table)
    {
        return array_values($table)[0];
    }

    public function getFirstItem()
    {
        $data = $this->getData();
        if (isset($data[0])) {
            return $data[0];
        } else {
            return $this->_model;
        }
    }
}

?>