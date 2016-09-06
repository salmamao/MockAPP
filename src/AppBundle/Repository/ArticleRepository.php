<?php

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
    public function createUser(\AppBundle\Entity\Article $article)
    {
        $em = $this->getEntityManager();
        $em->persist($article);
        $em->flush();
    }

    public function updateUser(\AppBundle\Entity\Article $article)
    {
        $em = $this->getEntityManager();
        $em->persist($article);
        $em->flush();
    }
}