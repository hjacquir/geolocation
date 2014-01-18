<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Tests\Functional;

use \Hj\Console;
use \PHPUnit_Framework_TestCase;
use \Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

require '../../vendor/autoload.php';

/**
 * @covers \Hj\Console
 */
class ConsoleTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $commandName;
    
    /**
     * @var string
     */
    private $commandTester;
    
    public function setUp()
    {
        $application = new Application();
        $application->add(new Console());
        
        $command = $application->find('s:l');
        $this->commandName = $command->getName();
        
        $this->commandTester = new CommandTester($command);
    }
    
    public function testShouldGetTheLatitudeAndLongitudeOfAnExistingPlace()
    {
        $input = array(
            'command'      => $this->commandName,
            'streetNumber' => '2',
            'streetName'   => array('avenue', 'général', 'patton'),
            'locality'     => 'Angers',
            'country'      => 'France',
        );
        
        $this->commandTester->execute($input);
        
        $this->assertContains('Latitude : 47.4737658 and Longitude : -0.5804685', $this->commandTester->getDisplay());
    }
    
    public function testShouldThrowAnExceptionWhenThePlaceNotExist()
    {
        $input = array(
            'command'      => $this->commandName,
            'streetNumber' => '2',
            'streetName'   => array('avenue', 'général', 'patton'),
            'locality'     => 'Canada',
            'country'      => 'France',
        );
        
        $this->commandTester->execute($input);
        
        $this->assertContains('It seems that the location you requested does not exist', $this->commandTester->getDisplay());
    }
}
