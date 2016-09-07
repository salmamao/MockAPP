<?php

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
    public function createArticle(\AppBundle\Entity\Article $article)
    {
        $em = $this->getEntityManager();
        $em->persist($article);
        $em->flush();
    }

    public function updateArticle(\AppBundle\Entity\Article $article)
    {
        $em = $this->getEntityManager();
        $em->persist($article);
        $em->flush();
    }
}