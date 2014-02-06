<?php
namespace Application\Bundle\RealistateBundle\Repository;

use Doctrine\ORM\EntityRepository;

class RealistateImageRepository extends EntityRepository
{
    public function findByIds($ids)
    {
        $qb = $this->createQueryBuilder('ri');
        return $qb->where($qb->expr()->in('ri.id', $ids))
            ->getQuery()
            ->execute();
    }
}