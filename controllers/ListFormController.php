<?php

/**
 * Created by PhpStorm.
 * User: vesel
 * Date: 06.11.2015
 * Time: 19:55
 */
abstract class ListFormController extends FormController {

    private $dataFragments = array();
    private $dataFragmentCount = 0;

    public function process($params) {

        $this->onCreate($params);

        for ($i = 0; $i < count($this->dataFragments); $i++) {
            $frag = $this->dataFragments[$i];

            foreach ($frag->getComponents() as $comp) {
                $comp->id .= "_$i";
                $this->addComponent($comp);
            }
        }

        $this->data['components'] = $this->getComponents();
        $this->view = "form-basis";

        if($_POST) {
            $sender = $this->assignValuesFromPOST();
            $this->onPost($_POST, $sender);
        }
    }

    public function setDataFragments($data) {
        $this->dataFragments = $data;
        $this->dataFragmentCount = count($data);
    }

    public function addDataFragment(ListFormDataFragment $fragment) {
        $this->dataFragments[] = $fragment;
        $this->dataFragmentCount++;
    }

    public function getComponents() {
        return parent::getComponents();
    }


}