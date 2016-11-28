<?php

namespace Api\Business;
use Api\Connection\Connection;

class Business {

    public $connection;

    public $model;

    function __construct()
    {
        $this->connection   = new Connection();
    }
}