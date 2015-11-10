<?php

/**
 * Created by PhpStorm.
 * User: vesel
 * Date: 10.11.2015
 * Time: 17:55
 */
class ContentProvider extends Database {

    private $table;

    public function __construct($host, $database, $username, $password) {
        $this->connect($host, $username, $password, $database);
    }

    public function getRecords($startOffset, $count) {
        return $this->queryAll("SELECT * FROM $this->table LIMIT $startOffset OFFSET $count");
    }

    public function getRecord($cond, $params) {
        return $this->query("SELECT * FROM $this->table WHERE $cond", $params);
    }

}