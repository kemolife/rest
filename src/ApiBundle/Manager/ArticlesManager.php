<?php

namespace ApiBundle\Manager;

use ApiBundle\Entity\Articles;
use ApiBundle\Entity\Category;
use ApiBundle\Entity\Tag;
use ApiBundle\Helper\StingForPattern;
use Doctrine\ORM\EntityManager;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticlesManager
{
    /**
     * @var EntityManager
     */
    public $em;

    /**
     * BlogManager constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param Articles $article
     * @param Request $request
     */
    private function addCategory(Articles $article, Request $request)
    {
        $categoryName = explode(',' , $request->get('category'));
        $categoryEntity = new Category();
        foreach($categoryName as $item) {
            $category = $this->em
                ->getRepository(Category::class)
                ->findOneByName($item);
            if ($category === Null) {
                $categoryEntity->setName($item);
                $categoryEntity->setAlias(StingForPattern::changeString($item));
                $this->em->persist($categoryEntity);
                $this->em->flush();
                $article->addCategory($categoryEntity);
            }else{
                $article->addCategory($category);
                $this->em->persist($article);
            }
        }
    }

    /**
     * @param Articles $article
     * @param Request $request
     */
    private function addTag(Articles $article, Request $request)
    {
        $tagName = explode(',' , $request->get('tag'));
        $tagEntity = new Tag();
        foreach($tagName as $item) {
            $tag = $this->em
                ->getRepository(Tag::class)
                ->findOneByName($item);
            if ($tag === Null) {
                $tagEntity->setName($item);
                $tagEntity->setAlias(StingForPattern::changeString($item));
                $this->em->persist($tagEntity);
                $this->em->flush();
                $article->addTag($tagEntity);
            }else{
                $article->addTag($tag);
                $this->em->persist($article);
            }
        }
    }

    /**
     * @param Articles $article
     * @param Request $request
     * @return View
     */
    public function addArticle(Articles $article, Request $request)
    {
        $title = $request->get('title');
        $content = $request->get('content');
        $image = $request->files->get('image');
        $alias = StingForPattern::changeString($request->get('alias'));
        if(empty($alias)){
            $alias = StingForPattern::changeString($request->get('title'));
        }
        if(empty($title))
        {
            return new View("Title is required", Response::HTTP_NOT_ACCEPTABLE);
        }

        $article->setTitle($title);
        $article->setContent($content);
        $article->setImage($image);
        $article->setFile($image);
        $article->setAlias($alias);
        $article->setStatus(Articles::STS_ACTIVE);
        $article->setCreatedAt(new \DateTime('now'));

        $this->addCategory($article, $request);
        $this->addTag($article, $request);

        $this->em->persist($article);
        $this->em->flush();
        return new View("Article Added Successfully", Response::HTTP_OK);
    }

    /**
     * @param $title
     * @return View
     */
    public function getArticleByName($title)
    {
        $article = $this->em->getRepository('ApiBundle:Articles')->findOneByTitle($title);
        if ($article === null) {
            return new View("article not found", Response::HTTP_NOT_FOUND);
        }
        return $article;
    }
}