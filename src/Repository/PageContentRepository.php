<?php

namespace App\Repository;

use App\Entity\PageContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Exception;
use Symfony\Bridge\Doctrine\RegistryInterface;


/**
 * @method PageContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method PageContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method PageContent[]    findAll()
 * @method PageContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageContentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PageContent::class);
    }

    public function findByPageName($pageName): ?PageContent
    {
        $query = null;

        try {
            $query = $this->createQueryBuilder('p')
                ->andWhere('p.pageName = :val')
                ->setParameter('val', $pageName)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        } catch (Exception $e) {
            return null;
        }

        return $query;
    }
}
