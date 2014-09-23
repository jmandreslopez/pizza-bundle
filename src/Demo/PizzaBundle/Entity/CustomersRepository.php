<?php

namespace Demo\PizzaBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CustomersRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CustomersRepository extends EntityRepository
{
    /**
     * Get one record
     *
     * @called
     * - OrderControllerTest::testStep2WithId
     * @return query
     */
    public function getOne()
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('c.id')
            ->from($this->getEntityName(), 'c')
            ->orderBy('c.id')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }
}
