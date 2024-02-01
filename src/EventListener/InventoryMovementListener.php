<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Nextstore\SyliusInventoryPlugin\Model\InventoryMovementInterface;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Symfony\Component\Security\Core\Security;

final class InventoryMovementListener
{
    public function __construct(
        private Security $security,
        private EntityManagerInterface $em
    )
    {
    }

    public function setCreatedBy(ResourceControllerEvent $event): void
    {
        $inventoryMovement = $event->getSubject();
        if ($inventoryMovement instanceof InventoryMovementInterface) {
            $user = $this->security->getUser();
            if ($user !== null) {
                $inventoryMovement->setCreatedBy($user);
                $this->em->persist($user);
                $this->em->flush();
            }
        }
    }
}
