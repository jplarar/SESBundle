<?php

namespace Jplarar\SESBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('jplarar_ses');

        $rootNode
            ->children()
                ->arrayNode('amazon_ses')
                    ->children()
                        ->scalarNode('amazon_ses_key')
                            ->defaultValue(null)
                        ->end()
                        ->scalarNode('amazon_ses_secret')
                            ->defaultValue(null)
                        ->end()
                        ->scalarNode('amazon_ses_region')
                            ->defaultValue(null)
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
