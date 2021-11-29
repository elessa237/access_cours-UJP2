<?php

namespace App\Repository\Enseignement;

use App\Entity\Enseignement\Cour;
use App\Entity\InfoEtudiant\Filiere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use function Symfony\Component\String\u;

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
     * @param string $search
     * @return Cour[] Returns an array of Cour objects
     */

    public function findAllByFiliere(Filiere $filieres, string $search)
    {

        $query = $this->createQueryBuilder('c')
            ->where(':filieres MEMBER OF c.filieres')
            ->setParameter('filieres', $filieres)
            ->orderBy('c.publishedAt', 'DESC');

        if ($search) {

            $searchTerms = $this->extractSearchTerms($search);

            foreach ($searchTerms as $key => $term) {
                $query = $query
                    ->andWhere('c.nom LIKE :t_' . $key)
                    ->setParameter('t_' . $key, '%' . $term . '%');
            }

        }

        return
            $query
                ->getQuery()
                ->getResult()
        ;
    }
/**
* @param string $search
* @return Cour[] Returns an array of Cour objects
*/

    public function findAllCours(string $search)
    {

        $query = $this->createQueryBuilder('c')
            ->orderBy('c.publishedAt', 'DESC');

        if ($search) {

            $searchTerms = $this->extractSearchTerms($search);

            foreach ($searchTerms as $key => $term) {
                $query = $query
                    ->orWhere('c.nom LIKE :t_' . $key)
                    ->setParameter('t_' . $key, '%' . $term . '%');
            }

        }

        return
            $query
                ->getQuery()
                ->getResult()
            ;
    }

    private function extractSearchTerms(string $searchQuery): array
    {
        $searchQuery = u($searchQuery)->replaceMatches('/[[:space:]]+/', ' ')->trim();
        // ignore the search terms that are too short
        return array_unique($searchQuery->split(' '));
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
