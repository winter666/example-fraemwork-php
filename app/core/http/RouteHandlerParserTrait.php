<?php


namespace App\core\http;


use App\core\Exceptions\InvalidArgumentException;
use App\core\Exceptions\InvalidInstanceController;

trait RouteHandlerParserTrait
{
    protected function parse($classLink) {
        if (!empty($classLink)) {
            $arrData = explode('@', $classLink);
            if (count($arrData) === 2) {
                $class = $arrData[0];
                $method = $arrData[1];
                $fullClassName = $this->baseNamespace . ((!empty($this->namespace)) ? $this->namespace : '') . "\\" . $class;
                $obj = new $fullClassName;
                if (!($obj instanceof Controller)) {
                    throw new InvalidInstanceController($fullClassName . " must be instance of App\core\http\Controller");
                }

                return ['object' => $obj, 'method' => $method];
            }
        }
        throw new InvalidArgumentException;
    }
}