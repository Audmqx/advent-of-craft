<?php

namespace Test;

use Blog\Article;
use Test\ArticleBuilder;
use Blog\CommentAlreadyExistException;
use PHPUnit\Framework\TestCase;

class ArticleTests extends TestCase {
    private $article;

    public function testShouldAddCommentInAnArticle() {
        $this->when(function (Article $article) {
            $article->addComment(ArticleBuilder::COMMENT_TEXT, ArticleBuilder::AUTHOR);
        });

        $this->then(function (Article $article) {
            $this->assertCount(1, $article->getComments());
            $this->assertComment($article->getComments()[0], ArticleBuilder::COMMENT_TEXT, ArticleBuilder::AUTHOR);
        });
    }

    public function testShouldAddCommentInAnArticleContainingAlreadyAComment() {
        $newComment = 'New Comment';
        $newAuthor = 'New Author';

        $this->when(function (Article $article) use ($newComment, $newAuthor) {
            $article->addComment($newComment, $newAuthor);
        });

        $this->then(function (Article $article) use ($newComment, $newAuthor) {
            $this->assertCount(2, $article->getComments());
            $this->assertComment(end($article->getComments()), $newComment, $newAuthor);
        });
    }

    public function testFailWhenAddingAnExistingComment() {
        $article = ArticleBuilder::anArticle()->commented()->build();

        $this->expectException(CommentAlreadyExistException::class);

        $article->addComment($article->getComments()[0]->text, $article->getComments()[0]->author);
    }

    private function assertComment($comment, $commentText, $author) {
        $this->assertEquals($commentText, $comment->text);
        $this->assertEquals($author, $comment->author);
    }

    private function when(callable $act) {
        $article = ArticleBuilder::anArticle()->build();
        $act($article);
        $this->article = $article;
    }

    private function then(callable $act) {
        $act($this->article);
    }
}
