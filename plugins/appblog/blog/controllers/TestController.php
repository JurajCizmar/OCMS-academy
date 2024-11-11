<?php namespace AppBlog\Blog\Controllers;

use Backend\Classes\Controller;

class TestController extends Controller
{
    public function index()
    {
        // return 'INDEX page';
        $this->vars['hello'] = 'Hello World';
    }


    public function test()
    {
        return 'TEST page';
    }
}