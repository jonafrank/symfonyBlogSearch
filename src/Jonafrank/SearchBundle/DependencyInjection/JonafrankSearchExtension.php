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
class JonafrankSearchExtension extends Extension implements PrependExtensionInterface
{

    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');

        $searchConfig = $container->getExtensionConfig($this->getAlias())[0];

        if (empty($searchConfig['resource'])) {
            throw new InvalidConfigurationException('Node resource missing in jonafrank_search in config.yml');
        }
        if (!empty($searchConfig)) {
            switch ($searchConfig['search_engine']) {
                case 'google':
                        $container->setParameter('jonafrank.search.engine', 'google');
                        $config = array(
                            'google'  => array(
                                'search_key' =>  $searchConfig['google']['api_key']
                            )
                        );
                        $container->prependExtensionConfig('liip_search', $config);
                    break;
            }
        }

    }

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
