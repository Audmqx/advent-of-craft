<?php

namespace Test;

use Carbon\Carbon;

class ArticleBuilder {
    public const AUTHOR = "Pablo Escobar";
    public const COMMENT_TEXT = "Amazing article !!!";
    private $comments;

    public function __construct() {
        $this->comments = [];
    }

    public static function anArticle() {
        return new ArticleBuilder();
    }

    public function commented() {
        $this->comments[self::COMMENT_TEXT] = self::AUTHOR;
        return $this;
    }

    public function build() {
        $article = new Article(
            "Lorem Ipsum",
            "consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore"
        );

        foreach ($this->comments as $text => $author) {
            $article->addComment($text, $author, Carbon::now());
        }

        return $article;
    }
}

?>
