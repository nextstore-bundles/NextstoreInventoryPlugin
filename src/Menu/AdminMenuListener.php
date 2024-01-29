<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        $inventory = $menu
            ->addChild('inventory')
            ->setLabel('nextstore_sylius_inventory.ui.inventory')
        ;

        $inventory
            ->addChild('warehouse', ['route' => 'nextstore_sylius_inventory_admin_warehouse_index'])
            ->setLabel('nextstore_sylius_inventory.ui.warehouse')
            ->setLabelAttribute('icon', 'warehouse')
        ;

        $inventory
            ->addChild('inventory_product', ['route' => 'nextstore_sylius_inventory_admin_inventory_product_index'])
            ->setLabel('nextstore_sylius_inventory.ui.inventory_product')
            ->setLabelAttribute('icon', 'tag')
        ;

        $inventory
            ->addChild('inventory_movement', ['route' => 'nextstore_sylius_inventory_admin_inventory_movement_index'])
            ->setLabel('nextstore_sylius_inventory.ui.inventory_movement')
            ->setLabelAttribute('icon', 'sync')
        ;

        $inventory
            ->addChild('inventory_movement_log', ['route' => 'nextstore_sylius_inventory_admin_inventory_movement_log_index'])
            ->setLabel('nextstore_sylius_inventory.ui.inventory_movement_log')
            ->setLabelAttribute('icon', 'clipboard')
        ;
    }
}
