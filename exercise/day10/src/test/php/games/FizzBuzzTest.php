<?php

namespace Blog\Tests;

use PHPUnit\Framework\TestCase;
use Blog\Article;
use Blog\CommentAlreadyExistException;

class ArticleTest extends TestCase
{
    public const AUTHOR = "Pablo Escobar";
    private const COMMENT_TEXT = "Amazing article !!!";
    private Article $article;

    protected function setUp(): void
    {
        $this->article = new Article(
            "Lorem Ipsum",
            "consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore"
        );
    }

    public function testShouldAddCommentInAnArticle(): void
    {
        $this->article->addComment(self::COMMENT_TEXT, self::AUTHOR);

        $this->assertCount(1, $this->article->getComments());

        $comment = $this->article->getComments()[0];
        $this->assertEquals(self::COMMENT_TEXT, $comment->text());
        $this->assertEquals(self::AUTHOR, $comment->author());
    }

    public function testShouldAddCommentInAnArticleContainingAlreadyAComment(): void
    {
        $newComment = "Finibus Bonorum et Malorum";
        $newAuthor = "Al Capone";

        $this->article->addComment(self::COMMENT_TEXT, self::AUTHOR);
        $this->article->addComment($newComment, $newAuthor);

        $this->assertCount(2, $this->article->getComments());

        $lastComment = end($this->article->getComments());
        $this->assertEquals($newComment, $lastComment->text());
        $this->assertEquals($newAuthor, $lastComment->author());
    }

    /**
     * @test
     */
    public function addingAnExistingCommentShouldFail(): void
    {
        $this->article->addComment(self::COMMENT_TEXT, self::AUTHOR);

        $this->expectException(CommentAlreadyExistException::class);

        $this->article->addComment(self::COMMENT_TEXT, self::AUTHOR);
    }
}
