<?php

namespace App\Component;

class Input implements WebComponentInterface
{
    private string $id;
    private string $label;
    private InputType $type;

    /**
     * @param InputType $type
     * @param string $id
     * @param string $label
     */
    public function __construct(string $id, string $label, InputType $type = InputType::TEXT)
    {
        $this->id = $id;
        $this->label = $label;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return InputType
     */
    public function getType(): InputType
    {
        return $this->type;
    }


    public function render(): string
    {
        $output = '<label for="' . $this->getId() . '">' . $this->getLabel() . '</label>' . PHP_EOL;
        $output .= '<input id="'.$this->getId().'" name="'.$this->getId().'" type="'.$this->getType()->name.'">'.PHP_EOL;
        return $output;
    }
}