<?php
namespace App\Repository;

use App\Controller\Data\SearchData;
use App\Controller\Data\SearchDate;
use App\Controller\Data\SearchDomaine;
use App\Controller\Data\SearchType;
use App\Entity\Document;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
/**
 * @method Document|null find($id, $lockMode = null, $lockVersion = null)
 * @method Document|null findOneBy(array $criteria, array $orderBy = null)
 * @method Document[]    findAll()
 * @method Document[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Document::class);
    }

    // /**
    //  * @return Document[] Returns an array of Document objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Document
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findSearch(SearchData $search): array
    {
       $query = $this
            ->createQueryBuilder('d');

        if(!empty($search->q))
        {
            $query = $query
                ->where('d.keywords LIKE :q OR d.titre LIKE :q')
                ->setParameter('q', "%{$search->q}%");
        }
        //dd($query->getQuery()->getResult());
        
        return $query->getQuery()->getResult();
        
    }

    public function searchDomaine(SearchDomaine $search): array
    {
        $query = $this
        ->createQueryBuilder('d')
        ;

        if(!empty($search->q))
        {
            $query = $query
                    ->where('d.keywords LIKE :q OR d.titre LIKE :q')
                    ->setParameter('q', "%{$search->q}%");
        }

        if(!empty($search->documents))
        {
            $query = $query
                        ->where('d.domaine IN (:documents)')
                        ->setParameter('documents', $search->documents);
        
        }

        if(!empty($search->q) and !empty($search->documents))
        {
            $query = $query
                    ->andWhere('(d.keywords LIKE :q OR d.titre LIKE :q) and (d.domaine IN (:documents))')
                    ->setParameters([
                        'q' => "%{$search->q}%",
                        'documents' => $search->documents
                    ]);
        }
            //dd($query->getQuery()->getResult());
            
        return $query->getQuery()->getResult();
        
    }

    public function searchType(SearchType $search): array
    {
        $query = $this
        ->createQueryBuilder('d')
        ;

        if(!empty($search->typeDocuments))
        {
            $query = $query
                        ->where('d.typeDocument IN (:typeDocuments)')
                        ->setParameter('typeDocuments', $search->typeDocuments);
        }
    
        //dd($query->getQuery()->getResult());
        return $query->getQuery()->getResult();
    }

    public function searchDate(SearchDate $search): array
    {
        $query = $this
        ->createQueryBuilder('d')
        ;

        if(!empty($search->date))
        {
            $query = $query
                        ->where('d.dateProduction LIKE :date')
                        ->setParameter('date', "%{$search->date}%");
        }
    
        //dd($query->getQuery()->getResult());
        return $query->getQuery()->getResult();
    }

    public function getDocuments($page, $nbpages){
        $query=$this->createQueryBuilder('d');//alias
    
        $query->orderBy('d.datePublication', 'DESC')->getQuery();
    
        $query->setFirstResult(($page-1) * $nbpages)->setMaxResults($nbpages);
    
        return $query->getQuery()->getResult();
    
       }

   public function getDocumentWithKeyWords(){

        $query = $this->createQueryBuilder('d');
        $query->leftJoin('d.motClef', 'm')->addSelect('m')->orderBy('d.datePublication', 'DESC')->getQuery();

        return $query->getQuery()->getResult();
    
    }
}
?>
