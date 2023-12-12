<?php

namespace App\Component;

class Button
{

    private ButtonType $type;
    private string $id;

    /**
     * @param ButtonType $type
     */
    public function __construct(string $id, ButtonType $type = ButtonType::SUBMIT)
    {
        $this->id = $id;
        $this->type = $type;
    }

    /**
     * @return ButtonType
     */
    public function getType(): ButtonType
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }





}