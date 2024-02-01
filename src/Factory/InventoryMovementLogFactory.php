<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\Factory;

use Nextstore\SyliusInventoryPlugin\Model\InventoryMovementLogInterface;
use Nextstore\SyliusInventoryPlugin\Model\InventoryMovementLog;
use Nextstore\SyliusInventoryPlugin\Model\Warehouse;
use Sylius\Component\Resource\Factory\FactoryInterface;

class InventoryMovementLogFactory implements InventoryMovementLogFactoryInterface
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @param FactoryInterface<object> $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createNew(): InventoryMovementLogInterface
    {
        /** @var InventoryMovementLogInterface $log */
        $log = $this->factory->createNew();

        return $log;
    }

    public function writeLog(Warehouse $warehouse, $assignDate): InventoryMovementLogInterface
    {
        /** @var InventoryMovementLog $log */
        $log = $this->createNew();
        $log->setWarehouse($warehouse);
        $log->setAssignDate($assignDate);

        $totalStock = 0;
        /** @var InventoryProduct $product */
        foreach ($warehouse->getProducts() as $product) {
            $totalStock += (int) $product->getStock();
        }
        $log->setInitialStock($totalStock);

        return $log;
    }
}
