<?php

namespace App\Controller\Api;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use App\Entity\Article;

class BlogController extends FOSRestController
{
    /**
     * Get one article from bd
     *
     * @param  $id
     * @return \FOS\RestBundle\View\View
     *
     * @Rest\Get("/article/{id}")
     */
    public function getArticle(int $id): View
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneById($id);

        if (empty($article)) {
            throw $this->createNotFoundException(sprintf('This article with id "%d" not found!', $id));
        }

        return View::create($article, Response::HTTP_OK);
    }

    /**
     * Get all articles from bd
     *
     * @return \FOS\RestBundle\View\View
     *
     * @Rest\Get("/articles")
     */

    public function getAllArticle(): View
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        return View::create($articles, Response::HTTP_OK);
    }

    /**
     * Post new article in bd
     *
     * @param $request
     * @return View
     *
     * @Rest\Post("/article")
     */

    public function createArticle(Request $request)
    {
        $post = $request->request;

        $article = new Article();

        $article->setName($post->get('name'));
        $article->setText($post->get('text'));
        $article->setAuthor($post->get('author'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        return $this->view($article, Response::HTTP_CREATED);
    }



}