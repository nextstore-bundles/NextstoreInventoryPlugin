<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\Model;

use Sylius\Component\Resource\Model\TimestampableTrait;

class InventoryMovementProduct implements InventoryMovementProductInterface
{
    use TimestampableTrait;

    protected ?int $id = null;

    private InventoryProductInterface $product;

    private InventoryMovementInterface $movement;

    private int $quantity = 1;

    private ?string $notes;


    public function __construct()
    {
        $this->createdAt = new \DateTime;
        $this->updatedAt = new \DateTime;
    }

    // public function __toString()
    // {
    //     return $this->id;
    // }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getMovement(): ?InventoryMovementInterface
    {
        return $this->movement;
    }

    public function setMovement(?InventoryMovementInterface $movement): void
    {
        $this->movement = $movement;
    }

    public function getProduct(): ?InventoryProductInterface
    {
        return $this->product;
    }

    public function setProduct(?InventoryProductInterface $product): void
    {
        $this->product = $product;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): void
    {
        $this->notes = $notes;
    }
}
