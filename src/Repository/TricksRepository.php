<?php

namespace App\Repository;

use App\Entity\Tricks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;
/**
 * @extends ServiceEntityRepository<Tricks>
 *
 * @method Tricks|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tricks|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tricks[]    findAll()
 * @method Tricks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TricksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tricks::class);
    }
    public function findAll(): array
    {
        return parent::findAll();
    }

    public function findTricksPaginated(int $page, string $slug = '', int $limit = 6): array
    {

        $limit = abs($limit);
        $result = [];

        if ($slug) {

            $query = $this->getEntityManager()->createQueryBuilder()
                ->select('c','t')
                ->from('App\Entity\Tricks', 't')
                ->join('t.category', 'c')
                ->where("c.slug = '$slug'")
                ->setMaxResults($limit)
                ->setFirstResult(($page * $limit) - $limit);
        } else {
            $query = $this->getEntityManager()->createQueryBuilder()
            ->select('t')
            ->from('App\Entity\Tricks', 't')
            ->setMaxResults($limit)
            ->setFirstResult(($page * $limit) - $limit);
        }

        $paginator = new Paginator($query);
        $data = $paginator->getQuery()->getResult();

        if(empty($data)){
            return $result;
        }

        // Calcule le nombre de page
        $pages = ceil($paginator->count() / $limit);

        // Remplit le tableau
        $result['data'] = $data;
        $result['pages'] = $pages;
        $result['page'] = $page;
        $result['limit'] = $limit;

        return $result;

    }

    public function add(Tricks $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Tricks $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Tricks[] Returns an array of Tricks objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Tricks
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
