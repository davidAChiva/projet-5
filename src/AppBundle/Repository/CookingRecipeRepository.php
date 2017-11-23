<?php

namespace AppBundle\Repository;

/**
 * CookingRecipeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
use AppBundle\Form\PartOfMenuType;
use Doctrine\ORM\Tools\Pagination\Paginator;

class CookingRecipeRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAllRecipes($page, $nbPerPage)
    {
        $qb = $this->createQueryBuilder('c')
            ->getQuery();

        $qb ->setFirstResult(($page-1) * $nbPerPage)
            ->setMaxResults($nbPerPage);

        return new Paginator($qb, true);
    }

    public function getRecipesOfCategoryIngredient($idCategory)
    {
        $qb = $this->createQueryBuilder('c')
            ->innerJoin('c.ingredients','i')
            ->addSelect('i');

        $qb ->where('i.category = :idCategory')
            ->setParameter('idCategory',$idCategory);

        return $qb->getQuery()->getResult();
    }

    public function getRecipesOfIngredient($idIngredient)
    {
        $qb = $this->createQueryBuilder('c')
            ->innerJoin('c.ingredients','i')
            ->addSelect('i');

        $qb ->where('i.id = :idIngredient')
            ->setParameter('idIngredient', $idIngredient);

        return $qb->getQuery()->getResult();
    }

    public function getRecipesOfTypeMenu($idPartOfMenu)
    {
        $qb = $this->createQueryBuilder('c')
            ->innerJoin('c.partOfMenu', 'p')
            ->addSelect('p');

        $qb ->where('p.id = :idPartOfMenu')
            ->setParameter('idPartOfMenu', $idPartOfMenu);

        return $qb->getQuery()->getResult();
    }

    public function getRecipesOfCountry($idCountry)
    {
        $qb = $this->createQueryBuilder('c')
            ->innerJoin('c.specialtyCountry','s')
            ->addSelect('s');

        $qb ->where('s.id = :idCountry')
            ->setParameter('idCountry', $idCountry);

        return $qb->getQuery()->getResult();
    }

    public function getLastRecipes($limit)
    {
        $limit = (int)$limit;
        $qb = $this->createQueryBuilder('c')
            ->orderBy('c.id', 'DESC')
            ->setFirstResult(0)
            ->setMaxResults($limit);


        return $qb->getQuery()->getResult();
    }

    public function getResultJsonRecipe($term)
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c.name', 'c.id')
            ->where('c.name LIKE :term')
            ->setParameter('term', '%'.$term.'%');
        $recipes = $qb->getQuery()->getArrayResult();


        foreach($recipes as $recipe)
        {
           $results[] = array( 'label' => $recipe['name'],'value' => $recipe['name'], 'id' => $recipe['id']);
        }
        return $results;
    }

    public function getResultSearch($recipeName)
    {
        $qb = $this->createQueryBuilder('c')
            ->where('c.name LIKE :term')
            ->setParameter('term', '%'.$recipeName.'%');
        $recipes = $qb->getQuery()->getResult();

        return $recipes;
    }
}
