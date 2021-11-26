<?php


namespace App\core\http;


class Request
{
    private $protocol;
    private $domain;
    protected $ip;
    protected $headers;
    protected $body;
    private $method;
    private $uri;

    public function __construct() {
        $this->setProtocol();
        $this->setDomain();
        $this->setUri();
        $this->setHeaders();
        $this->setBody();
        $this->setMethodInLower();
        $this->setIp();
    }

    // Setters
    private function setProtocol() {
        $this->protocol = $_SERVER['REQUEST_SCHEME'];
    }

    private function setDomain() {
        $this->domain = $_SERVER["HTTP_HOST"];
    }

    private function setHeaders() {
        $this->headers = getallheaders();
    }

    private function setMethodInLower() {
        $this->method = mb_strtolower($_SERVER['REQUEST_METHOD']);
    }

    private function setUri() {
        $uri = str_replace('\\', '', $_SERVER['REQUEST_URI']);
        $uri = str_replace('/router', '', $uri);
        if ($position = strpos($uri, '?')) {
            $needle = substr($uri , $position);
            $uri = str_replace($needle, '', $uri);
        }
        $this->uri = $uri;
    }

    private function setBody() {
        $this->body = $_REQUEST;
    }

    private function setIp() {
        $this->ip = $_SERVER['REMOTE_ADDR'];
    }

    // Getters
    public function getIp() {
        return $this->ip;
    }

    public function getItem($key) {
        return $this->body[$key];
    }

    public function getAll() {
        return $this->body;
    }

    public function getHeader($name) {
        return $this->headers[$name];
    }

    public function getHeaders() {
        return $this->headers;
    }

    public function getRequestDomain() {
        return $this->protocol . "://" . $this->domain;
    }

    // Helpers
    private function compareMethod($needle) {
        return $this->method === mb_strtolower(trim($needle));
    }

    private function compareUri($needle) {
        return $this->uri === mb_strtolower(trim($needle));
    }

    public function compareRequest($method, $uri) {
        return $this->compareMethod($method) && $this->compareUri($uri);
    }
}