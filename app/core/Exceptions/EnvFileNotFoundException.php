<?php


namespace App\core\Exceptions;


class EnvFileNotFoundException extends \Exception
{
    protected $message = ".env file not found";

}