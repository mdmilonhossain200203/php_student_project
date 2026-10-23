<?php

namespace pages\dbc;

class dbc
{
    public $servername = "localhost";
    public $dbname = "student";
    public $username = "root";
    public $password = "";

    function connect()
    {
        try {
            $con = new \PDO(
                "mysql:host={$this->servername};dbname={$this->dbname}",
                $this->username,
                $this->password
            );

            $con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return $con;
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }
}
