<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\Model;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;

interface WarehouseInterface extends ResourceInterface, TimestampableInterface
{
    public function getName(): string;

    public function setName(string $name): void;

    public function getCode(): string;

    public function setCode(string $code): void;

    public function getLocation(): ?string;

    public function setLocation(?string $location): void;

    public function getProducts(): Collection|null;

    public function addProduct(InventoryProductInterface $product): void;

    public function removeProduct(InventoryProductInterface $product): void;

    public function getMovements(): Collection|null;

    public function addMovement(InventoryMovementInterface $movement): void;

    public function removeMovement(InventoryMovementInterface $movement): void;

    public function getLogs(): Collection|null;

    public function addLog(InventoryMovementLogInterface $log): void;

    public function removeLog(InventoryMovementLogInterface $log): void;
}
