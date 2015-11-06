<?php
/**
 * Created by PhpStorm.
 * User: vesel
 * Date: 06.11.2015
 * Time: 18:11
 */

class FormTextbox extends FormComponent {

    public $type;

    function __construct($id, $css, $text, $type) {
        parent::__construct($id, $css);

        $this->text = $text;
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type) {
        $this->type = $type;
    }





}