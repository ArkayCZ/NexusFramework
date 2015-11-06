<?php

/**
 * Created by PhpStorm.
 * User: vesel
 * Date: 06.11.2015
 * Time: 16:43
 */
class HomeController extends Controller {

    public function process($params) {
        $this->view = "home";
        $this->header["title"] = "HOME";
    }
}