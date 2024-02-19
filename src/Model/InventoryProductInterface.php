<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\Model;

use Sylius\Component\Product\Model\ProductInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;

interface InventoryProductInterface extends ResourceInterface, TimestampableInterface
{
    public function getStock(): int;

    public function setStock(int $stock): void;

    public function getWarehouse(): ?WarehouseInterface;

    public function setWarehouse(?WarehouseInterface $warehouse): void;

    public function getProduct(): ?ProductInterface;

    public function setProduct(?ProductInterface $product): void;

    public function getProductCode(): ?string;

    public function setProductCode(?string $code): void;
}
