<?php

/**
 * Created by PhpStorm.
 * User: vesel
 * Date: 14.11.2015
 * Time: 11:16
 */
class UserManager extends ContentProvider {

    public function __construct() {
        $this->table = 'users';

        if(!$this->isConnected()) {
            KeyConfigLoader::selectFile("database");
            $databaseHost = KeyConfigLoader::getValue("host");
            $databaseName = KeyConfigLoader::getValue("name");
            $databaseUsername = KeyConfigLoader::getValue("db-name");
            $databasePassword = KeyConfigLoader::getValue("password");

            parent::_construct($databaseHost, $databaseName, $databaseUsername, $databasePassword);
        }
    }

    public function login($username, $password) {
        $user = $this->queryOne("SELECT 'username', 'email', 'id', 'permission_level' FROM $this->table
      WHERE 'username' = ? AND 'password' = ?", array($username, $password));

        if(!$user) throw new Exception("Nonexistent user or incorrect password!");

        $_SESSION['user'] = $user;
    }

    public function register($username, $email, $password) {
        LibLoader::loadOne("string_util");
        $passwordHash = str_salted_hash($password);

        $user = array(
            'username' => $username,
            'email' => $email,
            'password' => $passwordHash
        );

        $this->insert($this->table, $user);
    }

    public function logout() {
        unset($_SESSION['user']);
    }
}