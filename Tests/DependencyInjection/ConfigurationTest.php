<?php

use Brammm\MenuBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Processor;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    public function testHasDefaultTheme()
    {
        $config = [];

        $config = $this->process($config);

        $this->assertNotEmpty($config['theme']);
    }

    public function testCanOverrideTheme()
    {
        $config = [
            ['theme' => 'foo']
        ];

        $config = $this->process($config);

        $this->assertEquals('foo', $config['theme']);
    }

    /**
     * Processes an array of configurations and returns a compiled version.
     *
     * @param array $configs An array of raw configurations
     *
     * @return array A normalized array
     */
    protected function process($configs)
    {
        $processor = new Processor();

        return $processor->processConfiguration(new Configuration(), $configs);
    }
}
