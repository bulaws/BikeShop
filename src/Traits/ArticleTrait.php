<?php

namespace App\Traits;

use App\Entity\Article;

trait ArticleTrait
{
    /**
     * Return list of articles from db
     *
     * @return array $article
     */
    public function getArticles(): array
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)->findAll();

        return $articles;
    }

    /**
     * Return one article from db
     *
     * @param Article $id
     * @return Article $article
     */
    public function getArticle(Article $id)
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)->find($id);

        return $article;
    }

}