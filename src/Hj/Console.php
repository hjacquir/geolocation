<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj;

use \Exception;
use \Httpful\Request;
use \Symfony\Component\Console\Command\Command;
use \Symfony\Component\Console\Input\InputArgument;
use \Symfony\Component\Console\Input\InputInterface;
use \Symfony\Component\Console\Output\OutputInterface;
use \Symfony\Component\Serializer\Encoder\JsonEncoder;
use \Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

/**
 * Class to run your command
 */
class Console extends Command
{
    /**
     * @var string
     */
    private $streetNumber = 'streetNumber';
    
    /**
     * @var string
     */
    private $streetName = 'streetName';
    
    /**
     * @var string
     */
    private $locality = 'locality';
    
    /**
     * @var string
     */
    private $country = 'country';
    
    protected function configure()
    {
        $this->setName('s:l')
                ->setDescription('Determine the latitude and longitude of a place')
                ->addArgument(
                        $this->country, 
                        InputArgument::REQUIRED, 
                        'Enter the country name'
                        )
                 ->addArgument(
                        $this->locality, 
                        InputArgument::OPTIONAL, 
                        'Enter the locality name'
                        )
                ->addArgument(
                        $this->streetNumber, 
                        InputArgument::OPTIONAL, 
                        'Enter the street number'
                        )
                ->addArgument(
                        $this->streetName, 
                        InputArgument::IS_ARRAY|InputArgument::OPTIONAL, 
                        'Enter the street name'
                        );
    }
    
    /**
     * @param InputInterface  $input 
     * @param OutputInterface $output 
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $streetNumber = $input->getArgument($this->streetNumber);
        $streetName   = $input->getArgument($this->streetName);
        $locality     = $input->getArgument($this->locality);
        $country      = $input->getArgument($this->country);
        
        $url = new ApiUrl();
        
        // convert the array street name given into string before add into parameters
        $streetName = $url->formatParameters($streetName);
        
        $paramaters = array(
            $streetNumber, 
            $streetName, 
            $locality, 
            $country
        );
        
        $apiResponse = Request::get($url->getTheUri($paramaters))->send();
        
        $encoder = new JsonEncoder();
        $normalizer = new GetSetMethodNormalizer();
        $mapping = new Mapping($apiResponse, $encoder, $normalizer);
        
        /**
         * @var Location
         */
        try {
            $location = $mapping->deserializeLatAndLng();
            $message = '<info>Latitude : ' . $location->getLat() . ' and Longitude : ' . 
                $location->getLng() . '</info>';
        } catch (Exception $ex) {
            $message = '<error>' . $ex->getMessage() . '</error>';
        }
        
        $output->writeln($message);
    }
}
