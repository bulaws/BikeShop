<?php

namespace App\Repository;

use App\Entity\Product;
use App\Model\Filter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @return Product[] Returns an array of Product objects
     */
    public function findByIdCategory(int $category_id) : ?array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.category = :val')
            ->setParameter('val', $category_id)
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }

    public function JoinedToProductImage() : ?array
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.productImage', 'c')
            ->andWhere('c.product = p.id')
            ->getQuery()
            ->getResult()
            ;
    }

    public function JoinedToProductImageById($id)
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.productImage', 'c')
            ->where('c.product = p.id')
            ->andWhere('p.id = val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByFilter(object $filter)
    {
        $query = $this->createQueryBuilder('p')
            ->leftJoin('p.productImage', 'c')
            ->where('c.product = p.id')
            ;
        if($filter->getSearch()) {
            $query->andWhere('p.name LiKE :name')
                ->setParameter('name', '%' .$filter->getSearch() .'%');
        }
        if($filter->getPriceFrom()) {
            $query->andWhere('p.price >= :from')
                ->setParameter('from', $filter->getPriceFrom());
        }
        if($filter->getPriceTo()) {
            $query->andWhere('p.price <= :to')
                ->setParameter('to', $filter->getPriceTo());
        }

        return $query->orderBy('p.price', $filter->getPrice())
            ->getQuery()
            ->getResult()
            ;

    }
}
