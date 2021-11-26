<?php
use App\core\http\Router;

(new Router)->get('/', 'MainController@index');