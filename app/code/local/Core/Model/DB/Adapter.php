<?php

class Core_Model_DB_Adapter
{
    protected $_config = [
        'hostname' => 'localhost',
        'dbname' => 'ecommerce',
        'username' => 'root',
        'password' => '',
        'port' => '3307',
    ];
    public $connect = null;

    public function connect()
    {
        if ($this->connect == null) {
            $this->connect = mysqli_connect(
                $this->_config['hostname'],
                $this->_config['username'],
                $this->_config['password'],
                $this->_config['dbname'],
                $this->_config['port']
            );
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                exit();
            }
        }
        return $this->connect;
    }

    public function fetchAll($query)
    {
        // echo $query;
        $result = mysqli_query($this->connect(), $query);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            // ;
            // print_r($row);
            $data[] = $row;
        }
        return $data;
    }
    public function fetchCol($query)
    {
        // echo $query;
        $result = mysqli_query($this->connect(), $query);
        $data = [];
        while ($row = $result->fetch_column()) {
            $data[] = $row;
        }
        return $data;
    }
    public function fetchRow($query)
    {
        $result = mysqli_query($this->connect(), $query);
        while ($row = $result->fetch_assoc()) {
            return $row;
        }
        // $data = mysqli_fetch_row($result);
        // return $data;
    }
    public function insert($query)
    {
        $result = mysqli_query($this->connect(), $query);
        while ($result) {
            return mysqli_insert_id($this->connect());
        }
        return false;

    }
    public function query($query)
    {
        $result = mysqli_query($this->connect(), $query);
        return $result;

    }

}
?>