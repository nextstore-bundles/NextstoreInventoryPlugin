<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\Entity;

use Sylius\Component\Core\Model\Product;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;

interface InventoryProductInterface extends ResourceInterface, TimestampableInterface
{
    public function getStock(): int;

    public function setStock(int $stock): void;

    public function getWarehouse(): ?Warehouse;

    public function setWarehouse(?Warehouse $warehouse): void;

    public function getProduct(): ?Product;

    public function setProduct(?Product $product): void;

    public function getProductCode(): ?string;

    public function setProductCode(?string $code): void;
}
