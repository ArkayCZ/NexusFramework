<?php

/**
 * Created by PhpStorm.
 * User: vesel
 * Date: 14.11.2015
 * Time: 14:21
 */
class LoginController extends FormController {

    private $usernameBox;
    private $passwordBox;

    private $submitButton;

    function onCreate($params) {
        if(isset($params[0]) && $params[0] == "register")
            $this->redir("/registration");

        $this->usernameBox = new FormTextbox("username", "", "Username: ", "text");
        $this->passwordBox = new FormTextbox("password", "", "Password: ", "password");
        $this->submitButton = new FormSubmit("submit-button", "", "Login");

        $this->addComponent($this->usernameBox);
        $this->addComponent($this->passwordBox);
        $this->addComponent($this->submitButton);
    }

    function onPost($postData, FormSubmit $sender) {
        $userManager = new UserManager();
        if($sender != $this->submitButton)
            throw new Exception("The post sender is invalid!");

        $userManager->login($this->usernameBox->text, $this->passwordBox->text);
    }
}