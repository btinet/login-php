<?php

namespace App\Component;

enum ButtonType : string
{
    case SUBMIT = ("Absenden");
    case RESET = ("Zurücksetzen");
}