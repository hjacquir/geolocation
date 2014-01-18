<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Tests\Unit;

use \Hj\Location;
use \PHPUnit_Framework_TestCase;

require_once '../../vendor/autoload.php';

/**
 * @covers Location
 */
class LocationTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Location
     */
    private $location;
    
    public function setUp()
    {
        $this->location = new Location();
    }
    
    public function testShouldSetAndGetTheLatitude()
    {
        $this->location->setLat('44.52255');
        
        $this->assertSame('44.52255', $this->location->getLat());
    }
    
    public function testShouldSetAndGetTheLongitude()
    {
        $this->location->setLng('2.2255');
        
        $this->assertSame('2.2255', $this->location->getLng());
    }
}
