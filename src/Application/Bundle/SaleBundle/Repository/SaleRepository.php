<?php
namespace Application\Bundle\SaleBundle\Repository;

use Doctrine\ORM\EntityRepository;

class SaleRepository extends EntityRepository
{
    /**
     * Find next sale by id
     * @param int $id
     *
     * @return mixed
     */
    public function findNextSale($id)
    {
        $qb = $this->createQueryBuilder('s')
            ->where('s.id > :itemId')
            ->setMaxResults(1)
            ->orderBy('s.id', 'ASC')
            ->setParameter('itemId', $id);

        $result = $qb->getQuery()->getResult();

        return empty($result)?null:reset($result);
    }

    /**
     * @param int $limit
     *
     * @return array
     */
    public function findLastItemsByCount($limit)
    {
        $qb = $this->createQueryBuilder('s')
            ->setMaxResults($limit)
            ->orderBy('s.id', 'DESC');

        return $qb->getQuery()->getResult();
    }
}