<?php

/**
 * Created by PhpStorm.
 * User: zidan
 * Date: 14.11.2015
 * Time: 11:16
 */
class RegistrationController extends FormController {

    private $userNameBox;
    private $passwordBox;
    private $passwordAgainBox;
    private $emailBox;
    private $antispamBox;

    function onCreate($params) {
        $this->userNameBox = new FormTextbox("username", "", "Username:", "text");
        $this->passwordBox = new FormTextbox("password", "", "Password:", "password");
        $this->passwordAgainBox = new FormTextbox("password-again", "", "Confirm password:", "password");
        $this->emailBox = new FormTextbox("email", "", "Email:", "email");
        $this->antispamBox = new FormTextbox("antispam", "", "Enter the current year: ", "number");

        $this->addComponent($this->userNameBox);
        $this->addComponent($this->passwordBox);
        $this->addComponent($this->passwordAgainBox);
        $this->addComponent($this->emailBox);
        $this->addComponent($this->antispamBox);
    }

    function onPost($postData, FormSubmit $sender) {
        $userManager = new UserManager();
    }
}