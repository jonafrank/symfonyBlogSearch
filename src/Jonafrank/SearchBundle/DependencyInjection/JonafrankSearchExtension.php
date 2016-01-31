<?php

namespace Jonafrank\SearchBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class JonafrankSearchExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $container->setParameter('jonafrank.search.results.template', $config['results_template']);
        switch ($config['search_engine']) {
            case 'google':
                $container->setParameter('jonafrank.search.engine', 'google');
                break;
            case 'elasticsearch':
                $container->setParameter('jonafrank.search.engine', 'elasticsearch');
            case 'doctrine':
                $container->setParameter('jonafrank.search.engine', 'doctrine');
                $container->setParameter('jonafrank.search.entity', $config['doctrine']['entity']);
                $container->setParameter('jonafrank.search.properties_search', $config['doctrine']['properties_search']);
        }

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
