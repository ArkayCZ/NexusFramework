<?php

/**
 * Created by PhpStorm.
 * User: vesel
 * Date: 06.11.2015
 * Time: 17:57
 */

//Everytime an ID is mentioned within this class in means name="" in HTML not id=""

abstract class FormController extends Controller {

    private $components = array();

    public function process($params) {

        $this->onCreate($params);

        if($_POST) {

            $postSender = null;

            foreach($this->components as $component) {
                if(get_class($component) == "FormTextbox")
                    $component->text = $_POST[$component->id];
                else if(get_class($component) == "FormSpinner")
                    $component->text = $_POST[$component->id];
                else if(get_class($component) == "FormSubmit")
                    $postSender = $component;
            }

            $this->onPost($_POST, $postSender);
        }

        $this->data['components'] = $this->components;
        $this->view = "form-basis";
    }

    public function addComponent($component) {
        $this->components[] = $component;
    }

    abstract function onCreate($params);
    abstract function onPost($postData, FormSubmit $sender);

}