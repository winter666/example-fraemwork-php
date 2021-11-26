<?php


namespace App\Controllers;


use App\core\http\Controller;
use App\core\http\Request;

class MainController extends Controller
{
    public function index(Request $request) {
        return $request;
    }
}