<?php

namespace Jonafrank\SearchBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('jonafrank_search');
        $rootNode
            ->children()
                ->enumNode('search_engine')
                    ->values(array('google', 'elasticsearch', 'doctrine'))
                ->end()
                ->scalarNode('results_template')->end()
                ->arrayNode('doctrine')
                    ->canBeEnabled()
                    ->children()
                        ->scalarNode('entity')->end()
                        ->arrayNode('properties_search')
                            ->prototype('scalar')
                        ->end()
                    ->end()
                ->end()
            ->end();

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
