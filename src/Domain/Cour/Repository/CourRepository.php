<?php

namespace App\Domain\Cour\Repository;

use App\Domain\Cour\Entity\Cour;
use App\Domain\Niveau\Entity\Niveau;
use App\Domain\Ue\Entity\Ue;
use App\Domain\Filiere\Entity\Filiere;
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
     * @param Niveau $niveau
     * @param Filiere $filieres
     * @param string $search
     * @param UE $filter
     * @return Cour[] Returns an array of Cour objects
     */
    public function findAllByFiliereAndNiveau(Niveau $niveau, Filiere $filieres, string $search, UE $filter=null)
    {

        $query = $this->createQueryBuilder('c')
            ->where(':filieres MEMBER OF c.filieres')
            ->andWhere('c.niveau = :niveau')
            ->setParameters([
                'filieres' => $filieres,
                'niveau'=> $niveau
            ])
            ->orderBy('c.publishedAt', 'DESC');

        if ($search) {

            $searchTerms = $this->extractSearchTerms($search);

            foreach ($searchTerms as $key => $term) {
                $query = $query
                    ->andWhere('c.nom LIKE :t_' . $key)
                    ->setParameter('t_' . $key, '%' . $term . '%');
            }

        }
        if($filter)
        {
            $query->andWhere('c.UE = :ue')
                ->setParameter('ue', $filter)
            ;
        }

        return
            $query
                ->getQuery()
                ->getResult();
    }

    /**
     * @param string $search
     * @param UE|null $filter
     * @return Cour[] Returns an array of Cour objects
     */
    public function findAllCours(string $search, UE $filter = null)
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
        if($filter)
        {
            $query->andWhere('c.UE = :ue')
                ->setParameter('ue', $filter)
            ;
        }

        return
            $query
                ->getQuery()
                ->getResult();
    }

    /**
     * @param int $limit
     * @param Filiere $filieres |null
     * @param Niveau $niveau
     * @return Cour[]
     */
    public function findLastFour(int $limit, ?Niveau $niveau = null, ?Filiere $filieres = null)
    {
        $query = $this->createQueryBuilder('c');
        if ($filieres) {
            $query->where(':filieres MEMBER OF c.filieres')
                ->setParameter('filieres', $filieres);
        }
        if ($niveau){
            $query->andWhere('c.niveau = :niveau')
                ->setParameter('niveau', $niveau);
        }


        $query->orderBy('c.publishedAt', 'ASC')
            ->setMaxResults($limit);
        return $query->getQuery()
            ->getResult();
    }

    private function extractSearchTerms(string $searchQuery): array
    {
        $searchQuery = u($searchQuery)->replaceMatches('/[[:space:]]+/', ' ')->trim();
        // ignore the search terms that are too short
        return array_unique($searchQuery->split(' '));
    }
}
