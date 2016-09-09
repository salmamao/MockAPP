<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 09/09/2016
 * Time: 14:52
 */

namespace AppBundle\Service;


use AppBundle\Entity\Article;


class ArticleServiceTest extends \PHPUnit_Framework_TestCase
{

    public function testCreateArticle()
    {
        $article = new Article();
        $article->setTitle('TestArticle');
        $article->setDescription('Test Article');
        $article->setBody('Test Article Test');

        $mockArticleRepository = $this
            ->getMockBuilder('AppBundle\Repository\ArticleRepository')
            ->disableOriginalConstructor()
            ->setMethods(array('createArticle'))
            ->getMock();


        $mockArticleService = $this->getMockBuilder('AppBundle\Service\ArticleService')
            ->setConstructorArgs(array($mockArticleRepository))
            ->setMethods(null)
            ->getMock();

        $result = $mockArticleService->createArticle($article, 1);

        $this->assertEquals($result, $article);
    }

}