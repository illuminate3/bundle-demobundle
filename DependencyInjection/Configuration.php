<?php

namespace App\Bundles\DemoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('demo');
        $rootNode = $treeBuilder->getRootNode();

        // Define the parameters that are allowed to configure your bundle.
        $rootNode
            ->children()
                ->scalarNode('some_parameter')->defaultValue('default_value')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
