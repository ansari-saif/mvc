<?php

/**
 * The home page model
 */
class Model
{
    private $conn;

    public function __construct()
    {
        $this->connect();
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    private function connect()
    {
        $this->host = env("DB_HOST");
        $this->user = env("DB_USER");
        $this->pass = env("DB_PASSWORD");
        $this->dbname = env("DB_DATABASE");

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname . '', $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        if (!$this->conn) {
            $this->error = 'Fatal Error :' . $e->getMessage();
        }

        return $this->conn;
    }

    public function disconnect()
    {
        if ($this->conn) {
            $this->conn = null;
        }
    }
    public function get($table, $id = NULL)
    {
        $sql = "SELECT * FROM $table" . ($id ? " WHERE id = $id" : "");
        $result = $this->conn->prepare($sql);
        $query = $result->execute();
        if ($query == false) {
            echo 'Error SQL: ' . $query;
            die();
        }
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $id ? $result->fetch() :  $result->fetchAll();
    }

    function save($data, $table, $id = null)
    {
        foreach ($data as $key => $value) {
            $array[] = "`$key`='" . $value . "'";
        }
        $datatoupdate = implode(", ", $array);
        if ($id) {
            $sql = "UPDATE `$table` SET $datatoupdate WHERE id = $id";
        } else {
            $sql = "INSERT INTO  `$table` SET $datatoupdate";
        }
        return $this->execute($sql);
    }

    function delete($table, $id)
    {
        $sql = "DELETE FROM $table WHERE id = $id";
        return $this->execute($sql);
    }

    public function getData($query, $all = true)
    {
        $result = $this->conn->prepare($query);
        $query = $result->execute();
        if ($query == false) {
            echo 'Error SQL: ' . $query;
            die();
        }
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $all ? $result->fetchAll() :  $result->fetch();
    }
    public function execute($query)
    {
        $response = $this->conn->exec($query);
        return $response;
    }

    public function paginate($query, $numRecords)
    {
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $totalRecordData = $this->getData($query);
        $totalRecord = count($totalRecordData);
        $limit = $numRecords;
        $start = $page ?  ($page - 1) * $limit : 0;
        $sql = $query . "  LIMIT $start, $limit ";
        $result = $this->getData($sql);
        $lastPage = ceil($totalRecord / $numRecords);

        return [
            "total_count" => $totalRecord,
            "current_page" => $page,
            "record_per_page" => $numRecords,
            "record_start_index" =>  $start,
            "last_page" => $lastPage,
            "data" => $result
        ];
    }
}
