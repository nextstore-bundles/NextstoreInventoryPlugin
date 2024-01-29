<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;

interface InventoryMovementLogInterface extends ResourceInterface, TimestampableInterface
{
    public function getInitialStock(): int;

    public function setInitialStock(int $initialStock): void;

    public function getFinalStock(): int;

    public function setFinalStock(int $finalStock): void;

    public function getAdded(): int;

    public function setAdded(int $added): void;

    public function getSubtracted(): int;

    public function setSubtracted(int $subtracted): void;

    public function getAssignDate(): ?\DateTime;

    public function setAssignDate(?\DateTime $assignDate): void;

    public function getWarehouse(): Warehouse;

    public function setWarehouse(Warehouse $warehouse): void;

    public function recalculate(): void;
}
