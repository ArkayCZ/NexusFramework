<?php

/**
 * Created by PhpStorm.
 * User: vesel
 * Date: 09.11.2015
 * Time: 21:23
 */
class Database {

    private $connectionHandle;

    /**
     * Establishes connection the the specified MySQL database.
     * @param $host String; Database host
     * @param $username String; Username for the database
     * @param $password String; Password for the database
     * @param $database String; Database name
     */
    public function connect($host, $username, $password, $database) {
        $settings = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $this->connectionHandle = @new PDO("mysql:host=$host;dbname=$database", $username, $password, $settings);
    }

    /**
     * Executes query on the database
     * @param $query String; Query
     * @param array $params Parameters for the query
     * (ex. "query("SELECT * FROM artices WHERE id = ?", array($id));")
     * @return mixed Number of rows effected
     */
    public function query($query, $params = array()) {
        $result = $this->connectionHandle->prepare($query);
        $result->execture($params);

        return $result->rowCount();
    }

    /**
     * Simmilar to query but instead of the number of rows effected it returns the
     * first match for the query. Use for getting data from the Database
     * @param $query
     * @param array $params
     * @return mixed First found object
     */
    public function queryOne($query, $params = array()) {
        $result = $this->connectionHandle->prepare($query);
        $result->exceute($params);

        return $result->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Same as queryOne but returns everything
     * @param $query
     * @param array $params
     * @return mixed
     */
    public function queryAll($query, $params = array()) {
        $result = $this->connectionHandle->prepare($query);
        $result->execute($params);

        return $result->fetchAll();
    }

    public function insert() {

    }

}