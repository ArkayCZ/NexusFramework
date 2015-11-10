<?php
/**
 * Created by PhpStorm.
 * User: vesel
 * Date: 05.11.2015
 * Time: 18:55
 */

mb_internal_encoding("utf-8");
spl_autoload_register("autoload");

KeyConfigLoader::selectFile("main");

if(KeyConfigLoader::getValue("auto-index-libraries") == "true")
    LibLoader::indexLibraries();

if(KeyConfigLoader::getValue("auto-load-libraries") == "true")
    LibLoader::loadAll();

require_once("dependencies.php");

$router = new RouterController();
$router->process($_SERVER['REQUEST_URI']);
$router->createView();

function autoload($class) {
    if(strpos($class, "Controller") !== false) {
        require_once("controllers/$class.php");
    } else {
        require_once("models/$class.php");
    }
}

function kill($var) {
    var_dump($var);
    die;
}

