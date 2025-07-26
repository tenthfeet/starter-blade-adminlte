<?php

namespace App\Enums;

use App\Traits\InteractWithCases;
use JsonSerializable;

enum Status: int implements JsonSerializable
{
    use InteractWithCases;

    case Active = 1;
    case Inactive = 2;
}
