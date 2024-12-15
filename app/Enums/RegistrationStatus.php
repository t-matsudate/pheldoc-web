<?php

namespace App\Enums;

enum RegistrationStatus
{
    case Requested;
    case Reviewed;
    case Registered;
}
