<?php

namespace App\Exception;

use Exception;

class NotABuffetException extends Exception
{
    protected $message = 'Please do not mix the carnivorous and non-carnivorous dinosaurs. It will be a massacre!';
}
