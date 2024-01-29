<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\Service;

use Doctrine\ORM\EntityManagerInterface;
use Nextstore\SyliusInventoryPlugin\Entity\InventoryMovement;
use Nextstore\SyliusInventoryPlugin\Entity\InventoryMovementProduct;
use Nextstore\SyliusInventoryPlugin\Entity\InventoryMovementLog;
use Nextstore\SyliusInventoryPlugin\Factory\InventoryMovementLogFactoryInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

class InventoryMovementService
{
    /**
     * @param FactoryInterface<object> $inventoryFactory
     */
    public function __construct(
        private EntityManagerInterface $entityManager,
        private InventoryMovementLogFactoryInterface $inventoryMovementLogFactory
    ) {
    }

    public function writeLog(InventoryMovement $movement): void
    {
        $warehouse = $movement->getWarehouse();

        $assignDate = $movement->getAssignDate();


        /** @var InventoryMovementLog $log */
        $log = $this->entityManager->getRepository(InventoryMovementLog::class)
                                   ->findOneBy([
                                       'warehouse' => $warehouse,
                                       'assignDate' => $assignDate
                                   ]);

        if (!$log instanceof InventoryMovementLog) {
            $log = $this->inventoryMovementLogFactory->writeLog($warehouse, $assignDate);
        }

        $quantity = 0;
        /** @var InventoryMovementProduct $movementProduct */
        foreach ($movement->getProducts() as $movementProduct) {
            $quantity += (int) $movementProduct->getQuantity();
            $product = $movementProduct->getProduct();
            $productStock = $movement->getType() === InventoryMovement::INCOME
                ? $product->getStock() + $movementProduct->getQuantity()
                : $product->getStock() - $movementProduct->getQuantity();

            $product->setStock($productStock >= 0 ? $productStock : 0);
            $this->entityManager->persist($product);
        }
        if ($movement->getType() === InventoryMovement::INCOME) {
            $log->setAdded($log->getAdded() + $quantity);
        } else {
            $log->setSubtracted($log->getSubtracted() + $quantity);
        }
        $log->setUpdatedAt(new \DateTime());

        $this->entityManager->persist($log);
        $this->entityManager->flush();
    }

    public function addProductToMovement($data): void
    {
        foreach ($data->getProducts() as $movementProduct) {
            $this->entityManager->persist($movementProduct);
        }
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }
}
