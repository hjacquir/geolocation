<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj;

use \Exception;
use \Symfony\Component\Serializer\Encoder\JsonEncoder;
use \Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use \Symfony\Component\Serializer\Serializer;

/**
 * This class is used to convert the json response into reusable objects (deserialize)
 */
class Mapping
{
    const STATUS_ZERO_RESULTS = 'ZERO_RESULTS';
    
    /**
     * @var string|array
     */
    private $response;
    
    /**
     * @var string
     */
    private $format = 'json';
    
    /**
     * @param array|string           $response The response send by the API
     * @param JsonEncoder            $encoder  The type of encoder needed by the serializer component
     * @param GetSetMethodNormalizer $normalizer The normalizer needed by the serializer component
     */
    public function __construct(
            $response, 
            JsonEncoder $encoder, 
            GetSetMethodNormalizer $normalizer
    ) {
        $this->response   = $response;
        $this->serializer = new Serializer(array($normalizer), array($encoder));
    }
    
    /**
     * @return Object
     *  
     * @throws Exception
     */
    public function deserializeLatAndLng()
    {
        if (false === $this->isFound()) {
            
            throw new Exception('It seems that the location you requested does not exist') ;
        }

        $result = $this->response->body->results[0]->geometry->location;
        
        return $this->serializer->deserialize(json_encode($result), '\Hj\Location', $this->format); 
    }
    
    /**
     * @return boolean
     */
    private function isFound()
    {
        $isFound = true;
        // return 'OK' or 'ZERO_RESULTS'
        $status = $this->response->body->status;
        
        if (self::STATUS_ZERO_RESULTS == $status) {
            $isFound = false;
        }
        
        return $isFound;
    }
}
