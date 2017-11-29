<?php

namespace AppBundle\Repository;

/**
 * CommentRecipeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentRecipeRepository extends \Doctrine\ORM\EntityRepository
{
    public function getCommentsOfRecipe($idRecipe)
    {
        $qb = $this->createQueryBuilder('co')
            ->innerJoin('co.cookingRecipe', 'cr')
            ->addSelect('cr');

        $qb ->where('cr.id = :idRecipe')
            ->setParameter('idRecipe', $idRecipe);

        return $qb->getQuery()->getResult();
    }

    public function getNotesRecipe($idRecipe)
    {
        $qb = $this->createQueryBuilder('co')
            ->select('avg(co.note) as average')
            ->innerJoin('co.cookingRecipe', 'cr');

        $qb ->where('cr.id = :idRecipe')
            ->setParameter('idRecipe', $idRecipe);

        return $qb->getQuery()->getResult();
    }

    public function getRecipeWithAverageNote()
    {
        $qb = $this->createQueryBuilder('com')
            ->select('avg(com.note) as average, coo.id')
            ->innerJoin('com.cookingRecipe', 'coo');
        $qb ->orderBy('average','DESC');

        return $qb->getQuery()->getResult();
    }
}
