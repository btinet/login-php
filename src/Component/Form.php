<?php

namespace App\Component;

class Form implements WebComponentInterface
{

    private String $action;
    private String $method;
    private String $id;

    private array $inputFields;
    private array $buttons;

    /**
     * @param array $inputFields
     * @param array $buttons
     * @param String $action
     * @param String $method
     */
    public function __construct(array $inputFields, array $buttons = [new Button('submit')] ,string $action = '', string $method = 'post')
    {
        $this->action = $action;
        $this->method = $method;

        // Eingabefelder zur Liste hinzufügen
        foreach ($inputFields as $inputField) {
            if ($inputField instanceof Input) $this->inputFields[] = $inputField;
        }

        // Buttons zur Liste hinzufügen
        foreach ($buttons as $button) {
            if ($button instanceof Button) $this->buttons[] = $button;
        }

    }

    public function render() : string
    {
        $output = '<form method="'.$this->getMethod().'" id="'.$this->getId().'">';

        foreach ($this->inputFields as $inputField) {
            /** @var $inputField Input  */
            $output .= $inputField->render();
        }

        foreach ($this->buttons as $button) {
            /** @var $button Button  */
            $output .= '<button id="'.$button->getId().'" name="'.$button->getId().'" class="btn btn-primary" value="'.$button->getType()->name.'" type="'.$button->getType()->name.'">'.$button->getType()->value.'</button>'.PHP_EOL;
        }

        $output .= '</form>';

        return $output;
    }


    public function getAction(): string
    {
        return $this->action;
    }

    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    public function getId(): string
    {
        return $this->id ?? '';
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }



}