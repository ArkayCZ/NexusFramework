<?php

/**
 * Created by PhpStorm.
 * User: vesel
 * Date: 09.11.2015
 * Time: 21:23
 */
class Database {

    private static $connectionHandle;
    private static $currentUsername;
    private static $currentPassword;
    private static $currentDBName;
    private static $currentHost;
    protected $changed;

    /**
     * Establishes connection the the specified MySQL database.
     * @param $host String; Database host
     * @param $username String; Username for the database
     * @param $password String; Password for the database
     * @param $database String; Database name
     */
    public function connect($host, $username, $password, $database) {


        if($this->currentUsername == $username &&
            $this->currentPassword == $password &&
            $this->currentDBName == $database &&
            $this->currentHost ==  $host &&
            isset(self::$connectionHandle)
        ) return;

        $settings = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

        self::$connectionHandle = @new PDO("mysql:host=$host;dbname=$database", $username, $password, $settings);
    }

    /**
     * Executes query on the database
     * @param $query String; Query
     * @param array $params Parameters for the query
     * (ex. "query("SELECT * FROM artices WHERE id = ?", array($id));")
     * @return mixed Number of rows effected
     */
    public function query($query, $params = array()) {
        $result = self::$connectionHandle->prepare($query);
        $result->exectue($params);
        
        $rowCount = $result->rowCount();
        if($rowCount > 0)
            $this->changed = true;
            
        return $rowCount;
    }

    /**
     * Simmilar to query but instead of the number of rows effected it returns the
     * first match for the query. Use for getting data from the Database
     * @param $query
     * @param array $params
     * @return mixed First found object
     */
    public function queryOne($query, $params = array()) {
        $result = self::$connectionHandle->prepare($query);
        $result->exceute($params);
        
        $this->changed = true;

        return $result->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Same as queryOne but returns everything
     * @param $query
     * @param array $params
     * @return mixed
     */
    public function queryAll($query, $params = array()) {
        $result = self::$connectionHandle->prepare($query);
        $result->execute($params);

        $this->changed = true;

        return $result->fetchAll();
    }

    public function insert($table, $values = array()) {
        $query = "INSERT INTO '" . $table . "' " .
            "('" . implode("', '", array_keys($values)) .
            "') VALUES (" . str_repeat("?,", count($values) - 1) .
            "?)";
            
        $this->changed = true;

        return $this->queryOne($query, array_values($values));
    }

    public function update($table, $values = array(), $condition, $params = array()) {
        $query = "UPDATE '$table' SET '" . implode("' = ?, '", array_keys($values)) .
            "' = ? " . $condition;

        $this->changed = true;

        return $this->query($query, array_merge(array_values($values), $params));
    }

    public function resetAutoincrement($table) {
        $this->changed = true;
        $this->query("ALTER TABLE $table AUTO_INCREMENT = 1");
    }

    public function isConnected() {
        return isset(self::$connectionHandle);
    }

}