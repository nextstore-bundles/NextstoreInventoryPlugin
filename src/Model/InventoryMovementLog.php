<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\Model;

use DateTime;
use Sylius\Component\Resource\Model\TimestampableTrait;

class InventoryMovementLog implements InventoryMovementLogInterface
{
    use TimestampableTrait;

    protected ?int $id = null;

    private ?DateTime $assignDate;

    /** @var int */
    private int $initialStock = 0;

    /** @var int */
    private int $finalStock = 0;

    /** @var int */
    private int $added = 0;

    /** @var int */
    private int $subtracted = 0;

    private Warehouse $warehouse;

    public function __construct()
    {
        $this->createdAt = new \DateTime;
        $this->updatedAt= new \DateTime;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInitialStock(): int
    {
        return $this->initialStock;
    }

    public function setInitialStock(int $initialStock): void
    {
        $this->initialStock = $initialStock;
    }

    public function getFinalStock(): int
    {
        return $this->finalStock;
    }

    public function setFinalStock(int $finalStock): void
    {
        $this->finalStock = $finalStock;
    }

    public function getAdded(): int
    {
        return $this->added;
    }

    public function setAdded(int $added): void
    {
        $this->added = $added;
        $this->recalculate();
    }

    public function getSubtracted(): int
    {
        return $this->subtracted;
    }

    public function setSubtracted(int $subtracted): void
    {
        $this->subtracted= $subtracted;
        $this->recalculate();
    }

    public function getAssignDate(): ?\DateTime
    {
        return $this->assignDate;
    }

    public function setAssignDate(?\DateTime $assignDate): void
    {
        $this->assignDate = $assignDate;
    }

    public function getWarehouse(): Warehouse
    {
        return $this->warehouse;
    }

    public function setWarehouse(Warehouse $warehouse): void
    {
        $this->warehouse = $warehouse;
    }

    public function recalculate(): void
    {
        $added = $this->added;
        $subtracted = $this->subtracted;
        $initial = $this->initialStock;

        $this->finalStock = $initial + $added - $subtracted;
    }
}
