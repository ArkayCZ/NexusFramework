<?php

/**
 * Created by PhpStorm.
 * User: vesel
 * Date: 06.11.2015
 * Time: 18:42
 */

class TestFormController extends ListFormController {

    private $testBox;

    function onCreate($params) {
        $dataFragment = new ListFormDataFragment();
        $this->testBox = new FormTextbox("name", "", "Siemka PL", "text");
        $dataFragment->addComponent($this->testBox);

        $this->addDataFragment($dataFragment);
    }

    function onPost($postData, FormSubmit $sender) {

    }
}