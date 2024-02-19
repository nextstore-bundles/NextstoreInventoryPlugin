<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\Model;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;

interface InventoryMovementProductInterface extends ResourceInterface, TimestampableInterface
{
    public function getQuantity(): int;

    public function setQuantity(int $quantity): void;

    public function getMovement(): ?InventoryMovementInterface;

    public function setMovement(?InventoryMovementInterface $movement): void;

    public function getProduct(): ?InventoryProductInterface;

    public function setProduct(?InventoryProductInterface $product): void;

    public function getNotes(): ?string;

    public function setNotes(?string $notes): void;
}
