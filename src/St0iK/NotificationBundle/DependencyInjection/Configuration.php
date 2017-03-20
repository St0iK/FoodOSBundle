<?php

namespace St0iK\NotificationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

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
        $rootNode = $treeBuilder->root('stoik_notification');

        $rootNode->children()
            ->scalarNode("message")->defaultValue("")->end()
            ->scalarNode("title")->defaultValue("")->end()
            ->scalarNode("class")->defaultValue("notice")->end()
            ->scalarNode("type")->defaultValue("flash")->end()
            ->scalarNode("lifetime")->defaultValue(6000)->end()
            ->booleanNode("click_to_close")->defaultFalse()->end()
            ->end();

        return $treeBuilder;
    }
}
