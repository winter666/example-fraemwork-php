<?php

namespace App\core\http;


class Router {
    use RouteHandlerParserTrait;

    private $namespace = '';
    private $baseNamespace = 'App\Controllers';
    /**
     * @var Request $request
     */
    private $request;

    public function __construct() {
        $this->request = new Request();
    }

    public function post(string $uri, string $classLink) {
        if ($this->request->compareRequest('post', $uri)) {
            $entities = $this->parse($classLink);
            $handler = $entities['object'];
            $method = $entities['method'];
            $answer = $handler->$method($this->request);
            return $answer;
        }
    }

    public function get(string $uri, string $classLink, array $getData = []) {
        if ($this->request->compareRequest('get', $uri)) {
            $entities = $this->parse($classLink);
            $handler = $entities['object'];
            $method = $entities['method'];
            $answer = $handler->$method($this->request);
            return $answer;
        }
    }

    public function namespace(string $namespace) : Router {
        $this->namespace = $namespace;
        return $this;
    }

}
