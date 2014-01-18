<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj;

use \Httpful\Request;

/**
 * This class deals with the query API and return the response
 */
class ApiResponse
{
    /**
     * @var string|array The API response
     */
    private $response;
    
    /**
     * @param string $uri The formatted url with parameters
     */
    public function __construct($uri)
    {
        $this->response = Request::get($uri)->send();
    }
    
    /**
     * @return string|array The response
     */
    public function getResponse()
    {
        return $this->response;
    }
}
