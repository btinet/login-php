<?php

namespace App\Component;

class LoginForm extends Form
{

    private Input $usernameInput;
    private Input $passwordInput;

    private Button $submitButton;
    private Button $resetButton;

    public function __construct()
    {
        $this->usernameInput = new Input('usr','Benutzername');
        $this->passwordInput = new Input('pwd','Passwort',InputType::PASSWORD);
        $this->submitButton = new Button('submitBtn');
        $this->resetButton = new Button('resetBtn', ButtonType::RESET);

        parent::__construct(
            [$this->usernameInput,$this->passwordInput],
            [$this->submitButton,$this->resetButton]
        );
    }

    /**
     * @return Input
     */
    public function getUsernameInput(): Input
    {
        return $this->usernameInput;
    }

    /**
     * @return Input
     */
    public function getPasswordInput(): Input
    {
        return $this->passwordInput;
    }

    /**
     * @return Button
     */
    public function getSubmitButton(): Button
    {
        return $this->submitButton;
    }

    /**
     * @return Button
     */
    public function getResetButton(): Button
    {
        return $this->resetButton;
    }

}
