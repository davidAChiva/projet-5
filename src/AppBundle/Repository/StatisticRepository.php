<?php

namespace AppBundle\Repository;

/**
 * StatisticRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StatisticRepository extends \Doctrine\ORM\EntityRepository
{
    public function getVisitRecipe($idRecipe,$ipVisitor)
    {
        $qb = $this->createQueryBuilder('s')
            ->innerJoin('s.cookingRecipe','c')
            ->addSelect('c');

        $qb ->where('s.ipVisitor = :ipVisitor')
            ->andWhere('c.id = :idRecipe')
            ->setParameter('ipVisitor',$ipVisitor)
            ->setParameter('idRecipe',$idRecipe);

        return $qb->getQuery()->getResult();
    }
}
