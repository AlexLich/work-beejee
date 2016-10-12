<?php
namespace App\Core;
class RouteContext
{
    protected $params;
    protected $queries;
    function __construct($params, $queries)
    {
        $this->params = $params;
        $this->queries = $queries;
    }

    public function getParams()
    {
        // if (is_null($this->params)) {
        //     return false;
        // }
        // else {
            return $this->params;
        // }
    }

    public function getQueries()
    {
        // if (is_null($this->queries)) {
        //     return false;
        // }
        // else {
            return $this->queries;
        // }

    }
}
