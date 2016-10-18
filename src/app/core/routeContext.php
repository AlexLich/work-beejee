<?php
namespace App\Core;

class RouteContext
{
    protected $params;
    protected $queries;
    public function __construct($params, $queries)
    {
        $this->params = $params;
        $this->queries = $queries;
    }

    public function getParams()
    {
            return $this->params;
    }

    public function getQueries()
    {
            return $this->queries;
    }
}
