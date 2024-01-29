<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\AdminUser;
use Sylius\Component\Resource\Model\TimestampableTrait;

class InventoryMovement implements InventoryMovementInterface
{
    use TimestampableTrait;

    public const INCOME = 'income';
    public const OUTCOME = 'outcome';

    public const STATE_NEW = 'new';
    public const STATE_COMPLETED = 'completed';
    public const STATE_CANCELLED= 'cancelled';

    protected ?int $id = null;

    private ?string $type;

    private ?string $state;

    private ?string $notes;

    private ?DateTime $assignDate;

    private Warehouse $warehouse;

    private ?AdminUser $createdBy;

    private Collection $products;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->products = new ArrayCollection();
        $this->state = self::STATE_NEW;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): void
    {
        $this->notes = $notes;
    }

    public function getWarehouse(): ?Warehouse
    {
        return $this->warehouse;
    }

    public function setWarehouse(?Warehouse $warehouse): void
    {
        $this->warehouse = $warehouse;
    }

    public function getCreatedBy(): ?AdminUser
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?AdminUser $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    public function getAssignDate(): ?\DateTime
    {
        return $this->assignDate;
    }

    public function setAssignDate(?\DateTime $assignDate): void
    {
        $this->assignDate = $assignDate;
    }

    public function getProducts(): Collection|null
    {
        return $this->products;
    }

    public function addProduct(InventoryMovementProduct $product): void
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setMovement($this);
        }
    }

    public function removeProduct(InventoryMovementProduct $product): void
    {
        if ($this->products->contains($product)) {
            $this->products->remove($product);
            $product->setMovement(null);
        }
    }
}
