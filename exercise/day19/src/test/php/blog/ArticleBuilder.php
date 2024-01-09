<?php

namespace Test;

use Blog\Article;
use Innmind\Immutable\Either;


class ArticleBuilder
{
    public const AUTHOR = "Pablo Escobar";
    public const COMMENT_TEXT = "Amazing article !!!";

    private array $comments = [];

    public function __construct()
    {
    }

    public static function anArticle(): ArticleBuilder
    {
        return new ArticleBuilder();
    }

    public function commented(): ArticleBuilder
    {
        $this->comments[] = [
            'text' => self::COMMENT_TEXT,
            'author' => self::AUTHOR,
        ];

        return $this;
    }

    public function build(): Article|Either
    {
        $article = new Article('', ''); // Remplacez les chaînes vides par des valeurs par défaut si nécessaire

        foreach ($this->comments as $comment) {
            $article = $article->addComment($comment['text'], $comment['author']);
        }

        return $article;
    }
}