<?php

namespace App\Component;

enum InputType : string
{
    case TEXT = ('text');
    case PASSWORD = ('password');
    case DATE = ('date');
}