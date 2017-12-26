<?php

namespace ApiBundle\Controller;

use ApiBundle\Entity\Articles;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends FOSRestController
{

    /**
     * get all articles
     * @Rest\Get("/articles")
     */
    public function getAction()
    {
        $articles = $this->getDoctrine()->getRepository('ApiBundle:Articles')->findAll();
        if ($articles === []) {
            return new View("there are no articles exist", Response::HTTP_NOT_FOUND);
        }
        return $articles;
    }

    /**
     * get one article by name
     * @param $title
     * @Rest\Get("/article/{title}")
     * @return View
     */
    public function idAction($title)
    {
       return $this->get('manager_articles')->getArticleByName($title);
    }

    /**
     * post article
     * @param Request $request
     * @Rest\Post("/article")
     * @return View
     */
    public function postAction(Request $request)
    {
        $article = new Articles();
        return $this->get('manager_articles')->addArticle($article, $request);

    }

    /**
     *
     * @param $title, Request $request
     * @Rest\Put("/article/on-of/{title}")
     */
    public function onOfAction($title, Request $request)
    {
        $article = $this->getDoctrine()->getRepository('ApiBundle:Articles')->findOneByTitle($title);
        if($article === null){
            return new View("article not found", Response::HTTP_NOT_FOUND);
        }
    }
}
