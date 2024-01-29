<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\Repository\Inventory;

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Resource\Repository\RepositoryInterface;

class InventoryProductRepository extends EntityRepository implements RepositoryInterface
{
    public function findByProductCode(?string $phrase = null, ?string $warehouse = null, int $limit)
    {
        $qb = $this->createQueryBuilder('ip')
            ->leftJoin('ip.warehouse', 'w');
        if ($phrase) {
            $qb->andWhere('ip.productCode LIKE :phrase')
               ->setParameter('phrase', '%' . $phrase . '%');
        }
        if ($warehouse) {
            $qb->andWhere('w.code = :code')
               ->setParameter('code', $warehouse);
        }

        return $qb->setMaxResults($limit)
                  ->getQuery()
                  ->getResult()
              ;
    }
}
