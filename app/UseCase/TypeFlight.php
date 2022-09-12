<?php
namespace App\UseCase;

enum TypeFlight: string
{
    case UNSCALED = "Non-stop flight";
    case WITH_SCALE = "Stopover flight";
}
