<?php

namespace App\Component;

class Form
{

    private String $action;
    private String $method;
    private String $id;

    private array $inputFields;
    private array $buttons;



    /**
     * @param String $action
     * @param String $method
     */
    public function __construct(string $action, string $method)
    {
        $this->action = $action;
        $this->method = $method;
    }

    public function render() : string
    {
        return '<form method="'.$this->getMethod().'"><label>Username<input type="text" required></label><button type="submit">Absenden</button></form>';
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
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }



}