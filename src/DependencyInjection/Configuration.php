<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\DependencyInjection;

use Nextstore\SyliusInventoryPlugin\Factory\InventoryMovementLogFactory;
use Nextstore\SyliusInventoryPlugin\Form\Type\InventoryMovementType;
use Nextstore\SyliusInventoryPlugin\Form\Type\InventoryProductType;
use Nextstore\SyliusInventoryPlugin\Form\Type\WarehouseType;
use Nextstore\SyliusInventoryPlugin\Model\InventoryMovement;
use Nextstore\SyliusInventoryPlugin\Model\InventoryMovementInterface;
use Nextstore\SyliusInventoryPlugin\Model\InventoryMovementLog;
use Nextstore\SyliusInventoryPlugin\Model\InventoryMovementLogInterface;
use Nextstore\SyliusInventoryPlugin\Model\InventoryMovementProduct;
use Nextstore\SyliusInventoryPlugin\Model\InventoryMovementProductInterface;
use Nextstore\SyliusInventoryPlugin\Model\InventoryProduct;
use Nextstore\SyliusInventoryPlugin\Model\InventoryProductInterface;
use Nextstore\SyliusInventoryPlugin\Model\Warehouse;
use Nextstore\SyliusInventoryPlugin\Model\WarehouseInterface;
use Nextstore\SyliusInventoryPlugin\Repository\Inventory\InventoryMovementLogRepository;
use Nextstore\SyliusInventoryPlugin\Repository\Inventory\InventoryMovementProductRepository;
use Nextstore\SyliusInventoryPlugin\Repository\Inventory\InventoryMovementRepository;
use Nextstore\SyliusInventoryPlugin\Repository\Inventory\InventoryProductRepository;
use Nextstore\SyliusInventoryPlugin\Repository\Inventory\WarehouseRepository;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
use Sylius\Component\Resource\Factory\Factory;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * @psalm-suppress UnusedVariable
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('nextstore_sylius_inventory');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('driver')->defaultValue(SyliusResourceBundle::DRIVER_DOCTRINE_ORM)->end()
            ->end()
        ;

        $this->addResourcesSection($rootNode);

        return $treeBuilder;
    }

    /**
     * @param ArrayNodeDefinition $node
     */
    private function addResourcesSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('resources')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('warehouse')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(Warehouse::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(WarehouseInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->defaultValue(WarehouseRepository::class)->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                        ->scalarNode('form')->defaultValue(WarehouseType::class)->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('inventory_movement')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(InventoryMovement::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(InventoryMovementInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->defaultValue(InventoryMovementRepository::class)->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                        ->scalarNode('form')->defaultValue(InventoryMovementType::class)->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('inventory_movement_log')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(InventoryMovementLog::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(InventoryMovementLogInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->defaultValue(InventoryMovementLogRepository::class)->end()
                                        ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('inventory_movement_product')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(InventoryMovementProduct::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(InventoryMovementProductInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->defaultValue(InventoryMovementProductRepository::class)->end()
                                        ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('inventory_product')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(InventoryProduct::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(InventoryProductInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->defaultValue(InventoryProductRepository::class)->end()
                                        ->scalarNode('form')->defaultValue(InventoryProductType::class)->end()
                                        ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
