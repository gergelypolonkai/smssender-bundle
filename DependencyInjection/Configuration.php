<?php
namespace GergelyPolonkai\SmsSenderBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Description of Configuration
 *
 * @author Gergely Polonkai
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('gergely_polonkai_sms_sender');

        $rootNode
            ->children()
                ->booleanNode('verify_ssl')
                    ->defaultTrue()
                ->end()
                ->scalarNode('sender_url')
                    ->isRequired()
                ->end()
                ->scalarNode('content_type')
                    ->defaultValue('application/json')
                ->end()
                ->scalarNode('content_encoding')
                    ->defaultValue('utf-8')
                ->end()
                ->booleanNode('verbose_curl')
                    ->defaultFalse()
                ->end()
                ->scalarNode('username')
                    ->isRequired()
                ->end()
                ->scalarNode('password')
                    ->isRequired()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
