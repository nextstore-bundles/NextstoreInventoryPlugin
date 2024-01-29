<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;

interface InventoryMovementProductInterface extends ResourceInterface, TimestampableInterface
{
    public function getQuantity(): int;

    public function setQuantity(int $quantity): void;

    public function getMovement(): ?InventoryMovement;

    public function setMovement(?InventoryMovement $movement): void;

    public function getProduct(): ?InventoryProduct;

    public function setProduct(?InventoryProduct $product): void;

    public function getNotes(): ?string;

    public function setNotes(?string $notes): void;
}
