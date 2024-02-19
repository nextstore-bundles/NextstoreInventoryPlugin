<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\Model;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\AdminUserInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;

interface InventoryMovementInterface extends ResourceInterface, TimestampableInterface
{
    public function getType(): string;

    public function setType(string $type): void;

    public function getState(): string;

    public function setState(string $state): void;

    public function getNotes(): ?string;

    public function setNotes(?string $notes): void;

    public function getWarehouse(): ?WarehouseInterface;

    public function setWarehouse(?WarehouseInterface $warehouse): void;

    public function getCreatedBy(): ?AdminUserInterface;

    public function setCreatedBy(?AdminUserInterface $createdBy): void;

    public function getAssignDate(): ?\DateTime;

    public function setAssignDate(?\DateTime $assignDate): void;

    public function getProducts(): Collection|null;

    public function addProduct(InventoryMovementProductInterface $product): void;

    public function removeProduct(InventoryMovementProductInterface $product): void;
}
