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

    public function getPermissionLevel() {
        if(!$_SESSION['user'])
            return 0;
    }

    /**
     * Creates the view assigned to this controller (renders it)
     * @throws Exception Thrown in case the view file does not exist or no view is specified
     */
    public function createView() {
        if($this->view && Files::existsView($this->view)) {
            extract($this->data);
            require("views/$this->view.php");
        } else {
            throw new Exception("Failed to find view '$this->view'!");
        }
    }

    /**
     * Redirects to another location
     * @param $url String; URL to be redirected to (ex. 'home/page/2')
     */
    public function redir($url) {
        header("Location: " . $url);
        header("Connection: close");
        exit;
    }

    public function addMessage($message) {
        if(!isset($_SESSION['messages']))
            $_SESSION['messages'] = array();

        $_SESSION['messages'][] = $message;
    }

    public function getMessages() {
        if(isset($_SESSION['messages']))
            return $_SESSION['messages'];
        else return array();
    }

}