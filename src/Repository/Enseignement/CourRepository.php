<?php

namespace App\Repository\Enseignement;

use App\Entity\Enseignement\Cour;
use App\Entity\InfoEtudiant\Filiere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cour|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cour|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cour[]    findAll()
 * @method Cour[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cour::class);
    }

    /**
     * @param Filiere $filieres
     * @return Cour[] Returns an array of Cour objects
     */

    public function findAllByFiliere(Filiere $filieres)
    {
        return $this->createQueryBuilder('c')
            ->where(':filieres MEMBER OF c.filieres')
            ->setParameter('filieres', $filieres)
            ->orderBy('c.publishedAt', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Cour
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
