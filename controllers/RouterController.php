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

        //Loads router config
        ItemConfigLoader::selectFile("routing-exceptions");
        $this->exceptions = ItemConfigLoader::getItemList();

        //if there are no parameters in the URL redirects to /home
        if(!$parameters[0])
            $this->redir("home");

        $controllerClass = $this->getClassName(array_shift($parameters));

        //if Controller class does not exists redirects to /error
        if(!$controllerClass || !Files::existsController($controllerClass))
            $this->redir("error");

        //checks routing rules
        foreach($this->exceptions as $exception) {
            if(($exception[1] . "Controller") == $controllerClass) {
                if($exception[0] == "block")
                    $this->redir("error");
                else if($exception[0] == "redir")
                    $this->redir($exception[2]);
            }
        }

        //Creates an inner controller according to the first parameter and then creates it's view
        $this->innerController = new $controllerClass;
        /** @noinspection PhpUndefinedMethodInspection */
        $this->innerController->process($parameters);

        $this->data["title"] = $this->innerController->header["title"];
        $this->data["keywords"] = $this->innerController->header["keywords"];
        $this->data["description"] = $this->innerController->header["description"];

        $this->view = "base-view";
    }

    /**
     * Parses the class name from the URL which is in format 'class-name' to camel case
     * 'ClassName' and appends 'Controller' to the end ('example-page' -> 'ExamplePageController'
     * @param $class String; Class name from the URL
     * @return string; Camel case class name
     */
    public function getClassName($class) {
        $class = trim($class);
        $class = str_replace("-", " ", $class);
        $class = ucwords($class);
        $class = str_replace(" ", "", $class);

        return $class . "Controller";
    }

    /**
     * Parses the url into format that can be used by NexusControllers
     * ('localhost/home/page/3' -> '[0] - home; [1] - page; [2] - 2')
     * @param $url String; URL to be parsed
     * @return array Parts of the URL split by '/'
     */
    public function parseURL($url) {
        $parsed = parse_url($url)['path'];
        $parsed = ltrim($parsed, "/");
        $parsed = trim($parsed);

        return explode("/", $parsed);
    }

}