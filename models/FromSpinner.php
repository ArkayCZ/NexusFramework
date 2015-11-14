<?php
/**
 * Created by PhpStorm.
 * User: vesel
 * Date: 06.11.2015
 * Time: 18:04
 */


class FromSpinner extends FormComponent {

    public $items = array();
    public $text = "";

    function __construct($id, $css, $label, $items) {
        parent::__construct($id, $css);

        $this->items = $items;
        $this->label = $label;
    }
}