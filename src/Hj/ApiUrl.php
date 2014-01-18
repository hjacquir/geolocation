<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj;

/**
 * Construct the specific URL to call the API
 */
class ApiUrl
{
    /**
     * Return the uri to call the API with the parameters
     * 
     * @param array $parameters An array of address components
     * 
     * @return string The final URI correctly formatted
     */
    public function getTheUri($parameters)
    {
        return 'http://maps.googleapis.com/maps/api/geocode/json?address=' . 
                $this->appendedUrlWithParameters($parameters) . '&sensor=true';
    }
    
    /**
     * Return the formatted string 
     * 
     * @param array $parameters An array of address components 
     * 
     * @return string A formatted string with implode
     */
    public function formatParameters($parameters)
    {
        return implode(' ', $parameters);
    }
    
    /**
     * Return the encoded url
     * 
     * @param string $parameters The address components parameters formatted to string
     * 
     * @return string The encoded url
     */
    private function appendedUrlWithParameters($parameters)
    {
        return urlencode($this->formatParameters($parameters));
    }
}
