<?php

/**
 * Created by PhpStorm.
 * User: vesel
 * Date: 06.11.2015
 * Time: 18:42
 */

class TestFormController extends ListFormController {

    private $testBox;
    private $submitButton;

    function onCreate($params) {
        $dataFragment = new ListFormDataFragment();
        $this->testBox = new FormTextbox("name", "", "Siemka PL", "text");
        $this->submitButton = new FormSubmit("submit", "", "Submit");

        $dataFragment->addComponent($this->testBox);
        $dataFragment->addComponent($this->submitButton);

        $this->addDataFragment($dataFragment);
    }

    function onPost($postData, FormSubmit $sender) {
        kill($this->testBox);
    }
}