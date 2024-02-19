<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\TimestampableTrait;

class Warehouse implements WarehouseInterface
{
    use TimestampableTrait;

    private ?int $id = null;

    /** @var string */
    private string $name;

    /** @var string */
    private string $code;

    /** @var string */
    private ?string $location = null;

    private Collection $products;

    private Collection $movements;

    private Collection $logs;

    public function __toString(): string
    {
        return $this->code;
    }

    public function __construct()
    {
        $this->movements = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): void
    {
        $this->location = $location;
    }

    public function getProducts(): Collection|null
    {
        return $this->products;
    }

    public function addProduct(InventoryProductInterface $product): void
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setWarehouse($this);
        }
    }

    public function removeProduct(InventoryProductInterface $product): void
    {
        if ($this->products->contains($product)) {
            $this->products->remove($product);
            $product->setWarehouse(null);
        }
    }

    public function getMovements(): Collection|null
    {
        return $this->movements;
    }

    public function addMovement(InventoryMovementInterface $movement): void
    {
        if (!$this->movements->contains($movement)) {
            $this->movements->add($movement);
            $movement->setWarehouse($this);
        }
    }

    public function removeMovement(InventoryMovementInterface $movement): void
    {
        if ($this->movements->contains($movement)) {
            $this->movements->remove($movement);
            $movement->setWarehouse(null);
        }
    }

    public function getLogs(): Collection|null
    {
        return $this->logs;
    }

    public function addLog(InventoryMovementLogInterface $log): void
    {
        if (!$this->logs->contains($log)) {
            $this->logs->add($log);
            $log->setWarehouse($this);
        }
    }

    public function removeLog(InventoryMovementLogInterface $log): void
    {
        if ($this->logs->contains($log)) {
            $this->logs->remove($log);
            $log->setWarehouse(null);
        }
    }
}
