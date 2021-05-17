<?php
namespace IT;

use IT\App;

/**
 * Simple MySQLi wrapper
 * @package IT\Database
 * @author JuicyCodes
 * @version 1.5.0
 * @created 08-2-17 4:26:40 PM
 * @modified 21-06-2017 03:18 AM
 */
class Database
{
    public $mysqli;
    public $query;
    public $error;
    public $rows;
    public $id;
    private $closed = false;

    /**
     * Open a new connection to the MySQL server & Set Character Set
     * @param string $host
     * @param string $username
     * @param string $password
     * @param string $database
     * @param int $port
     */
    public function __construct($host, $username, $password, $database, $port = null)
    {
        $this->mysqli = new \Mysqli($host, $username, $password, $database, $port);
        if ($this->mysqli->connect_error) {
            throw new \Exception("Unable To Connect To MYSQL :: {$this->_mysql->connect_error}");
        }
        $this->mysqli->set_charset(App::Get("charset"));
    }

    /**
     * Performs a query on the database
     * @param  string  $sql
     * @param  string $name Unique Identifier
     * @return boolean/object
     */
    public function query($sql, $name = false)
    {
        $return = $this->mysqli->query($sql);
        $this->add_vars($name, $sql);
        return $return;
    }

    /**
     * Performs a select query on the database
     * @param  string  $table
     * @param  array/boolean  $select
     * @param  array  $where
     * @param  int $limit
     * @param  string $extra
     * @param  string $name   Unique Identifier
     * @return boolean/object
     */
    public function select($table, $select = null, $where = null, $limit = false, $extra = false, $name = false)
    {
        $select = is_array($select) ? implode(", ", $select) : "*";
        $query  = "SELECT $select FROM $table";

        if (is_array($where) & !empty($where)) {
            $wheres = array();
            foreach ($where as $column => $value) {
                $wheres[] = "$column=" . ($value == 'NULL' ? 'NULL' : "'$value'");
            }
            $query .= " WHERE " . implode(" AND ", $wheres);
        }

        if ($limit) {
            $query .= " LIMIT $limit";
        }

        if ($extra) {
            $query .= " $extra";
        }
        return $this->query($query, $name);
    }

    /**
     * Performs a insert query on the database
     * @param  string  $table
     * @param  array   $data
     * @param  string $name  Unique Identifier
     * @return boolean/object
     */
    public function insert($table, array $data, $name = false)
    {
        $query   = "INSERT INTO $table ";
        $columns = $values = $rows = array();
        foreach ($data as $column => $value) {
            if (is_array($value)) {
                $is_multi = true;
                if (empty($columns)) {
                    $columns = array_keys($value);
                }
                $values[] = array_values($value);
            } else {
                $columns[] = $column;
                $values[]  = ($value == 'NULL' ? 'NULL' : "'$value'");
            }
        }
        $query .= "(" . implode(",", $columns) . ") VALUES ";
        if ($is_multi) {
            foreach ($values as $value) {
                $rows[] = "('" . implode("','", $value) . "')";
            }
            $query .= implode(",", $rows);
        } else {
            $query .= "(" . implode(",", $values) . ")";
        }
        return $this->query($query, $name);
    }

    /**
     * Performs a update query on the database
     * @param  string  $table
     * @param  array   $data
     * @param  array   $where
     * @param  string $name  Unique Identifier
     * @return boolean/object
     */
    public function update($table, array $data, array $where = array(), $name = false)
    {
        $query  = "UPDATE $table SET ";
        $values = array();
        foreach ($data as $column => $value) {
            $values[] = "$column=" . ($value == 'NULL' ? 'NULL' : "'$value'");
        }
        $query .= implode(",", $values);
        if (!empty($where)) {
            $wheres = array();
            foreach ($where as $column => $value) {
                $wheres[] = "$column=" . ($value == 'NULL' ? 'NULL' : "'$value'");
            }
            $query .= " WHERE " . implode(" AND ", $wheres);
        }
        return $this->query($query, $name);
    }

    /**
     * Performs a delete query on the database
     * @param  string  $table
     * @param  array   $data
     * @param  string $name  Unique Identifier
     * @return boolean/object
     */
    public function delete($table, array $data, $name = false)
    {
        $query   = "DELETE FROM $table WHERE ";
        $columns = array();
        foreach ($data as $column => $value) {
            $columns[] = $column . "='{$value}'";
        }
        $query .= implode(" AND ", $columns);
        return $this->query($query, $name);
    }

    /**
     * Add usefull varibale to class object
     * @param string $name Unique Identifier
     * @param string $sql  Query
     */
    private function add_vars($name = false, $sql = false)
    {
        $this->query = $sql;
        if ($name) {
            $this->{$name}->query = $sql;
        }
        if ($this->mysqli->error) {
            $this->error = $this->mysqli->error;
            if ($name) {
                $this->{$name}->error = $this->mysqli->error;
            }
        }
        if ($this->mysqli->insert_id) {
            $this->id = $this->mysqli->insert_id;
            if ($name) {
                $this->{$name}->id = $this->mysqli->insert_id;
            }
        }
        if (isset($this->mysqli->affected_rows)) {
            $this->rows = $this->mysqli->affected_rows;
            if ($name) {
                $this->{$name}->rows = $this->mysqli->affected_rows;
            }
        }
    }

    /**
     * Closes a previously opened database connection
     */
    public function close()
    {
        if ($this->closed === false) {
            $this->mysqli->close();
            $this->closed = true;
        }
    }

    /**
     * Closes a previously opened database connection on class destruct
     */
    public function __destruct()
    {
        $this->close();
    }
}
