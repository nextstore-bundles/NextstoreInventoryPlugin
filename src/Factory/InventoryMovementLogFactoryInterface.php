<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\Factory;

use Nextstore\SyliusInventoryPlugin\Model\InventoryMovementLogInterface;
use Nextstore\SyliusInventoryPlugin\Model\Warehouse;
use Sylius\Component\Resource\Factory\FactoryInterface;

interface InventoryMovementLogFactoryInterface extends FactoryInterface
{
    public function writeLog(Warehouse $warehouse, $assignDate): InventoryMovementLogInterface;
}
