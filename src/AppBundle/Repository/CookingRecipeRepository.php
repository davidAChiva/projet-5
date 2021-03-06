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
            ->where('c.published = true')
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

        $qb ->andWhere('i.category = :idCategory', 'c.published = true')
            ->setParameter('idCategory',$idCategory);


        return $qb->getQuery()->getResult();
    }

    public function getRecipesOfIngredient($idIngredient)
    {
        $qb = $this->createQueryBuilder('c')
            ->innerJoin('c.ingredients','i')
            ->addSelect('i');

        $qb ->andWhere('i.id = :idIngredient', 'c.published = true')
            ->setParameter('idIngredient', $idIngredient);

        return $qb->getQuery()->getResult();
    }

    public function getRecipesOfTypeMenu($idPartOfMenu)
    {
        $qb = $this->createQueryBuilder('c')
            ->innerJoin('c.partOfMenu', 'p')
            ->addSelect('p');

        $qb ->andWhere('p.id = :idPartOfMenu', 'c.published = true')
            ->setParameter('idPartOfMenu', $idPartOfMenu);

        return $qb->getQuery()->getResult();
    }

    public function getRecipesOfCountry($idCountry)
    {
        $qb = $this->createQueryBuilder('c')
            ->innerJoin('c.specialtyCountry','s')
            ->addSelect('s');

        $qb ->andWhere('s.id = :idCountry', 'c.published = true')
            ->setParameter('idCountry', $idCountry);

        return $qb->getQuery()->getResult();
    }

    public function getLastRecipes($limit)
    {
        $limit = (int)$limit;
        $qb = $this->createQueryBuilder('c')
            ->innerJoin('c.image','i')
            ->innerJoin('c.partOfMenu','p')
            ->innerJoin('c.specialtyCountry','s')
            ->addSelect('i','p','s')
            ->orderBy('c.id', 'DESC')
            ->setFirstResult(0)
            ->setMaxResults($limit);


        return $qb->getQuery()->getResult();
    }

    public function getResultJsonRecipe($term)
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c.name', 'c.id')
            ->andwhere('c.name LIKE :term', 'c.published = true')
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
            ->where('c.name LIKE :term', 'c.published = true')
            ->setParameter('term', '%'.$recipeName.'%');
        $recipes = $qb->getQuery()->getResult();

        return $recipes;
    }

    public function getRecipeMostPopular($limit)
    {
        $limit = (int)$limit;
        $qb = $this->createQueryBuilder('c')
            ->innerJoin('c.image','i')
            ->addSelect('i')
            ->where('c.published = true')
            ->orderBy('c.nbVisit', 'DESC')
            ->setFirstResult(0)
            ->setMaxResults($limit);

        $recipes = $qb->getQuery()->getResult();

        return $recipes;
    }

    public function getAllRecipeMostPopular()
    {
        $qb = $this->createQueryBuilder('c')
            ->where('c.published = true')
            ->orderBy('c.nbVisit', 'DESC');

        $recipesMostPopular = $qb->getQuery()->getResult();

        return $recipesMostPopular;
    }

    public function getRecipeMostAverageNotes()
    {
        $qb = $this->createQueryBuilder('c')
            ->innerJoin('c.image','i')
            ->addSelect('i')
            ->where('c.published = true')
            ->orderBy('c.averageNotes', 'DESC');
        $recipesMostAverage = $qb->getQuery()->getResult();

        return $recipesMostAverage;
    }

    public function getRecipesNotPublished()
    {
        $qb = $this->createQueryBuilder('c')
            ->innerJoin('c.image','i')
            ->addSelect('i')
            ->where('c.published = false');

        return $qb->getQuery()->getResult();
    }
}
