<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\Model;

use Sylius\Component\Core\Model\Product;
use Sylius\Component\Resource\Model\TimestampableTrait;

class InventoryProduct implements InventoryProductInterface
{
    use TimestampableTrait;

    protected ?int $id = null;

    private Product $product;

    /** @var int */
    private int $stock = 0;

    private Warehouse $warehouse;

    /** @var string */
    private string $productCode;

    public function __construct()
    {
        $this->createdAt = new \DateTime;
        $this->updatedAt= new \DateTime;
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

    public function getWarehouse(): ?Warehouse
    {
        return $this->warehouse;
    }

    public function setWarehouse(?Warehouse $warehouse): void
    {
        $this->warehouse = $warehouse;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): void
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
