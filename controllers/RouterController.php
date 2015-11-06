<?php

/**
 * Created by PhpStorm.
 * User: vesel
 * Date: 06.11.2015
 * Time: 16:23
 */
class RouterController extends Controller {

    protected $innerController;
    protected $exceptions = array();

    public function process($params) {
        $parameters = $this->parseURL($params);

        ItemConfigLoader::selectFile("routing-exceptions");
        $this->exceptions = ItemConfigLoader::getItemList();

        if(!$parameters[0])
            $this->redir("home");

        $controllerClass = $this->getClassName(array_shift($parameters));

        if(!$controllerClass || !Files::existsController($controllerClass))
            $this->redir("error");

        foreach($this->exceptions as $exception) {
            if(($exception[1] . "Controller") == $controllerClass) {
                if($exception[0] == "block")
                    $this->redir("error");
                else if($exception[0] == "redir")
                    $this->redir($exception[2]);
            }
        }

        $this->innerController = new $controllerClass;
        /** @noinspection PhpUndefinedMethodInspection */
        $this->innerController->process($parameters);

        $this->data["title"] = $this->innerController->header["title"];
        $this->data["keywords"] = $this->innerController->header["keywords"];
        $this->data["description"] = $this->innerController->header["description"];

        $this->view = "base-view";
    }

    public function getClassName($class) {
        $class = trim($class);
        $class = str_replace("-", " ", $class);
        $class = ucwords($class);
        $class = str_replace(" ", "", $class);

        return $class . "Controller";
    }

    public function parseURL($url) {
        $parsed = parse_url($url)['path'];
        $parsed = ltrim($parsed, "/");
        $parsed = trim($parsed);

        return explode("/", $parsed);
    }

}