<?php

namespace AppBundle\Repository;

/**
 * UtilisateurRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UtilisateurRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Sélection de l'Utilisateur correspondant à un Internaute donné
     *
     * @param $id_internaute
     */
    public function findUtilisateur($id_internaute)
    {

        $qb = $this->createQueryBuilder('u')->leftJoin('u.internaute', 'i')->addSelect('i');

        $qb->where('i.id=:id')->setParameter('id', $id_internaute);

        return $qb->getQuery()->getResult();
    }

    /**
     * @return array
     */
    public function findUtilisateurs()
    {
        $qb = $this->createQueryBuilder('u')->leftJoin('u.internaute','i')->andWhere('i.id like :id')->setParameter('id',!null);
       /* $qb=$this->createQueryBuilder('u')
            ->from('AppBundle:Utilisateur','i')
            ->where('i.id = ?6')
           ;*/
        return $qb->getQuery()->getResult();
    }

    /**
     * Récupération du nombre d'Utilisateur bannis
     */
    public function countBannedUsers()
    {

        $qb = $this->createQueryBuilder('u')->select('COUNT(u)')->andWhere('u.banni=:bool')->setParameter('bool', true);

        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Récupération des comptes Utilisateur bannis
     */
    public function findBannedUsers()
    {

        $qb = $this->createQueryBuilder('u')->andWhere('u.banni=:bool')->setParameter('bool', true);

        return $qb->getQuery()->getResult();
    }

    /**
     *  Récupération de l'Utilisateur propriétaire de l'Image du 'path' en param
     */
    public function findOwnerImage($path){
        $qb = $this->createQueryBuilder('u')->leftJoin('u.internaute','i')->addSelect('i')
            ->leftJoin('u.prestataire','p')->addSelect('p')
            ->leftJoin('i.image','img')->addselect('img')
            ->leftJoin('p.logo','logo')->addSelect('logo')
            ->leftJoin('p.cover','cover')->addSelect('cover')//->select('img.path')

          ->andWhere("img.path = :path")
            ->orWhere("logo.path = :path")
            ->orWhere("cover.path = :path");

        $qb->setParameter('path', $path)->select('u.username','img.path','cover.path','logo.path')/*->select('img.path')*/;

        return $qb->getQuery()->getResult();


    }
}
