<?php
namespace GergelyPolonkai\SmsSenderBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\FileLocator;

/**
 * Description of GergelyPolonkaiSmsSenderExtension
 *
 * @author Gergely Polonkai
 */
class GergelyPolonkaiSmsSenderExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        $container->setParameter('verify_ssl', $config['verify_ssl']);
        $container->setParameter('sender_url', $config['sender_url']);
        $container->setParameter('content_type', $config['content_type']);
        $container->setParameter('content_encoding', $config['content_encoding']);
        $container->setParameter('verbose_curl', $config['verbose_curl']);
        $container->setParameter('username', $config['username']);
        $container->setParameter('password', $config['password']);
    }
}
