<?php
namespace Jonafrank\SearchBundle\Tests\DependencyInjection;

use Jonafrank\SearchBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Processor;

/**
 * ConfigurationTest.
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Processor
     */
    private $processor;

    public function setUp()
    {
        $this->processor = new Processor();
    }

    private function getConfigs(array $configArray)
    {
        $configuration = new Configuration(true);

        return $this->processor->processConfiguration($configuration, array($configArray));
    }

    public function testElasticSearchConfiguration()
    {
        $configuration = $this->getConfigs(array(
            'search_engine' => 'elasticsearch',
            'results_template' => null
        ));
        $this->assertTrue(array_key_exists('search_engine', $configuration));
        $this->assertEquals('elasticsearch', $configuration['search_engine']);
    }

    public function testGoogleSearchConfiguration()
    {
        $configuration = $this->getConfigs(array(
            'search_engine' => 'google',
            'results_template' => null
        ));
        $this->assertEquals('google', $configuration['search_engine']);
    }

    /**
     * @expectedException Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testNotImplementedSearchEngine()
    {
        $configuration = $this->getConfigs(array(
            'search_engine' => 'unknown',
            'results_template' => null
        ));
    }
}
