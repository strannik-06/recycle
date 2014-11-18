<?php
namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Batterypack Repository
 */
class BatterypackRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function findAllGroupedByType()
    {
        return $this->createQueryBuilder('b')
            ->select(array(
                'b.type',
                'SUM(b.amount) as totalAmount',
            ))
            ->groupBy('b.type')
            ->getQuery()
            ->getArrayResult();
    }
}
