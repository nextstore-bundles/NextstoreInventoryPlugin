<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\Model;

use Sylius\Component\Product\Model\ProductInterface;
use Sylius\Component\Resource\Model\TimestampableTrait;

class InventoryProduct implements InventoryProductInterface
{
    use TimestampableTrait;

    protected ?int $id = null;

    private ProductInterface $product;

    /** @var int */
    private int $stock = 0;

    private WarehouseInterface $warehouse;

    /** @var string */
    private string $productCode;

    public function __construct()
    {
        $this->createdAt = new \DateTime;
        $this->updatedAt = new \DateTime;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

    public function getWarehouse(): ?WarehouseInterface
    {
        return $this->warehouse;
    }

    public function setWarehouse(?WarehouseInterface $warehouse): void
    {
        $this->warehouse = $warehouse;
    }

    public function getProduct(): ?ProductInterface
    {
        return $this->product;
    }

    public function setProduct(?ProductInterface $product): void
    {
        $this->product = $product;
    }

    public function getProductCode(): ?string
    {
        return $this->productCode;
    }

    public function setProductCode(?string $code): void
    {
        $this->productCode = $code;
    }
}
