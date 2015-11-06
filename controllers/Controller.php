<?php

/**
 * Created by PhpStorm.
 * User: vesel
 * Date: 05.11.2015
 * Time: 19:01
 */
abstract class Controller
{

    public $header = array("title" => "", "description" => "", "keywords" => "");
    public $data = array();
    public $view = "";

    public abstract function process($params);

    public function getCurrentUser() {

    }

    public function createView() {
        if($this->view && Files::existsView($this->view)) {
            extract($this->data);
            require("views/$this->view.php");
        } else {
            throw new Exception("Failed to find view '$this->view'!");
        }
    }

    public function redir($url) {
        header("Location: " . $url);
        header("Connection: close");
        exit;
    }

}