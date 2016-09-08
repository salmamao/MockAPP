<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 08/09/2016
 * Time: 21:00
 */

namespace AppBundle\Service;


use AppBundle\Entity\Article;
use AppBundle\Repository\ArticleRepository;

class ListArticleService
{
    protected $articleRepository;


    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function displayArticles(int $userId)
    {
        $articles = $this->articleRepository->findBy(
            array('user_id' => $userId)
        );

        return $articles;
    }

}