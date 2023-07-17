<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\ORM\Query;
use Entity\SearchCriteria;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Car>
 *
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }



    public function findAllNotSold(SearchCriteria $criteria) : Query {
        $query = $this->findAllQuery();
        
        if($criteria->getMaxCost())
        {
            $query = $query->andWhere('p.cost <= :maxcost')
                ->setParameter('maxcost', $criteria->getMaxCost());
        }
        
        if($criteria->getCarName())
        {
            $query = $query->andWhere($query->expr()->like('p.name',':carName'))
                ->setParameter('carName', '%' . $criteria->getCarName() . '%');
        }

        if($criteria->getCategories()->count() > 0)
        {
            $k = 0;
    
            foreach($criteria->getCategories() as $k => $category) 
            {
                $k++;
                $query = $query
                    ->andWhere(":category$k MEMBER OF p.categories")
                    ->setParameter("category$k", $category);
            }
        }

        return $query->getQuery();
    }

    public function findLatest() : array {
        return  $this->findAllQuery()
            ->orderBy('p.created_at', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    private function findAllQuery() : QueryBuilder {
        return $this->createQueryBuilder('p')
        ->where('p.isSold = false');
}

}
