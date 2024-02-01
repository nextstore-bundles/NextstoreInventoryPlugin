<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\DependencyInjection;

use Sylius\Bundle\ResourceBundle\DependencyInjection\Extension\AbstractResourceExtension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

final class NextstoreSyliusInventoryExtension extends AbstractResourceExtension
{
    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configs = $this->processConfiguration($this->getConfiguration([], $container), $configs);
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $this->registerResources('nextstore_sylius_inventory', $configs['driver'], $configs['resources'], $container);

        $loader->load('services.xml');
    }
}
