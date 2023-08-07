<?php

namespace App\Exceptions;

use Exception;

class PDOException extends Exception
{
    protected $message = 'Cette base de donnée n\'existe pas.';
}
