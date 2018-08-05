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

        return View::create($article, Response::HTTP_OK);
    }
}