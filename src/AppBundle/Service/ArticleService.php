<?php

namespace AppBundle\Service;

use AppBundle\Entity\Article;


use AppBundle\Repository\ArticleRepository;


class ArticleService
{

    protected $articleRepository;


    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;

    }


    public function createArticle(Article $article, int $id)
    {
        $article->setPublishedAt(new \DateTime());
        $article->setUserId($id);


        $this->articleRepository->createArticle($article);


        return $article;
    }


}
