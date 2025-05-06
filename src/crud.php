<?php
class Crud
{
    private $conn;

    public function __construct($host, $user, $pass, $db)
    {
        $this->conn = new mysqli($host, $user, $pass, $db);
        if ($this->conn->connect_error) {
            die("DB connection failed: " . $this->conn->connect_error);
        }
    }

    public function create($table, $data)
    {
        $keys = implode(",", array_keys($data));
        $values = implode("','", array_map([$this->conn, 'real_escape_string'], array_values($data)));
        $sql = "INSERT INTO $table ($keys) VALUES ('$values')";
        return $this->conn->query($sql);
    }

    public function read($table, $where = "1")
    {
        $sql = "SELECT * FROM $table WHERE $where";
        return $this->conn->query($sql);
    }

    public function update($table, $data, $where)
    {
        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "$key='" . $this->conn->real_escape_string($value) . "'";
        }
        $setStr = implode(",", $set);
        $sql = "UPDATE $table SET $setStr WHERE $where";
        return $this->conn->query($sql);
    }

    public function delete($table, $where)
    {
        $sql = "DELETE FROM $table WHERE $where";
        return $this->conn->query($sql);
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}
