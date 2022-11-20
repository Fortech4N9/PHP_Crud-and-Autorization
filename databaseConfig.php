<?php

class databaseConfig
{
    static $conn;
    public function createConnection(){
        //sql server configuration
        global $conn;
        $serverName = "FORTECHN9-PC";
        $dbUserName = "";
        $dbPassword = "";
        $dbName = "services";
        try {
            $conn = new PDO("sqlsrv:Server=$serverName;Database = $dbName", $dbUserName, $dbPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }catch (PDOException $e) {
            die("Error connecting to SQL Server" . $e->getMessage());
        }
    }
    public  function getArrayFromTable($sql,$conn){
        $query = $conn->prepare($sql);
        $query->execute();
        $members = $query->fetchAll(PDO::FETCH_ASSOC);
        return $members;
    }
    public function startSession(){
        if (!session_id()){
            session_start();
        }
    }
    public  function getItemFromTable($sql,$conn){
        $query = $conn->prepare($sql);
        $query->execute();
        $members = $query->fetch(PDO::FETCH_ASSOC);
        return $members;
    }

}