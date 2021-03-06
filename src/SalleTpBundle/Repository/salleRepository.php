<?php

namespace SalleTpBundle\Repository;

/**
 * salleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class salleRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByBatimentAndEtageMax($batiment, $etage){
        $queryBuider = $this->createQueryBuilder('s');
        $queryBuider->where('s.batiment = :batiment')
        ->setParameter('batiment', $batiment)
        ->andWhere('s.etage <= :etage')
        ->setParameter('etage', $etage)
        ->orderBy('s.etage', 'asc');
        return $queryBuider->getQuery()->getResult();
    }
    
    public function findSalleBatAouB(){
        $query = $this->getEntityManager()
        ->createQuery("select s from SalleTpBundle:Salle s where s.batiment in ('A','B')");
        return $query->getResult();
    }
    
    public function plusUnEtage(){
        $query = $this->getEntityManager()
        ->createQuery("Update SalleTpBundle:Salle s SET s.numero = s.numero +'1'");
        return $query->execute();
    }
    
    public function testGetResult(){
        $queryBuider = $this->createQueryBuilder('s');
        $queryBuider->where("s.batiment ='B'");
        $query = $queryBuider->getQuery();
        $result =$query->getResult();
        return $result;
    }
    
    public function testGetSingleScalarResult(){
        $queryBuider = $this->createQueryBuilder('s');
        $queryBuider->select('Count(s)');
        $queryBuider->where("s.batiment = 'B' ");
        $query = $queryBuider->getQuery();
        $result =$query->getSingleScalarResult();
        return $result;
    }
}
