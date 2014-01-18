<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Tests\Unit;

use \Hj\ApiUrl;
use \PHPUnit_Framework_TestCase;

require_once '../../vendor/autoload.php';

/**
 * @covers \Hj\ApiUrl
 */
class ApiUrlTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ApiUrl
     */
    private $apiUrl;
    
    public function setUp()
    {
        $this->apiUrl = new ApiUrl();
    }
    
    public function testShouldReturnTheUriToCallTheApiWithParameters()
    {
        $parameters = array('10', 'street of thor', 'Place of Gods', 'ASGARD');
        $expected = 'http://maps.googleapis.com/maps/api/geocode/json?address=10+street+of+thor+Place+of+Gods+ASGARD&sensor=true';
        
        $this->assertSame($expected, $this->apiUrl->getTheUri($parameters));
    }
            
    public function testShouldFormatParameters()
    {
        $parameters = array('1', 'street of Jedi', 'Locality of Jedi', 'CORUSCANT');
        
        $this->assertSame('1 street of Jedi Locality of Jedi CORUSCANT', $this->apiUrl->formatParameters($parameters));
    }
}
