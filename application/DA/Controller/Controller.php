<?php

namespace DA\Controller;

class Controller
{
    
    protected $app;
    
    public function __construct($app) {
        $this->app = $app;
    }
    
}