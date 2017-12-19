<?php

namespace Dawen\Bundle\ConfigToJsBundle\DependencyInjection;

use Dawen\Bundle\ConfigToJsBundle\Component\Renderer\ModuleRenderer;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Dawen\Bundle\ConfigToJsBundle\Component\ConfigDumper;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class ConfigToJsExtension extends Extension
{
    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $dumperDef = $container->getDefinition(ConfigDumper::class);
        $dumperDef
            ->setArgument('$type', $config['type'])
            ->setArgument('$outputPath', $config['output_path'])
            ->setArgument('$config', $config['config'])
            ->addMethodCall('registerRenderer', [new Reference(ModuleRenderer::class)]);
    }
}
