<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 07/09/2016
 * Time: 16:09
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Article;
use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
    public function createArticle(Article $article)
    {
        $em = $this->getEntityManager();
        $em->persist($article);
        $em->flush();
    }


}