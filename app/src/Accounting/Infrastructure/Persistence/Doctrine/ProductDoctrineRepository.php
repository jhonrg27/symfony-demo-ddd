<?php

namespace Misa\Accounting\Infrastructure\Persistence\Doctrine;

use Misa\Accounting\Domain\Product\Product;
use Misa\Accounting\Domain\Product\ProductRepository;
use MisaSdk\Common\Adapter\Persistence\Doctrine\DoctrineRepository;

/**
 * ProductRepository Class
 *
 * @package Misa\Accounting\Infrastructure\Persistence\Doctrine
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2017, Orbis
 */
class ProductDoctrineRepository extends DoctrineRepository implements ProductRepository
{
    /**
     * @inheritdoc
     */
    public function findById($productId)
    {
        return $this->repository->find($productId);
    }

    /**
     * @inheritdoc
     */
    public function findAll()
    {
        return $this->em->createQueryBuilder()
            ->select('p')
            ->from('Accounting:Product\Product', 'p')
            ->getQuery()
            ->useQueryCache(true)
            ->useResultCache(true, 7200)
            ->getResult();
    }

    /**
     * @inheritdoc
     */
    public function persist(Product $item)
    {
        $this->em->persist($item);
        $this->em->flush();
        return true;
    }

    /**
     * @inheritdoc
     */
    public function remove(Product $item)
    {
        $this->em->remove($item);
        $this->em->flush();
        return true;
    }
}
