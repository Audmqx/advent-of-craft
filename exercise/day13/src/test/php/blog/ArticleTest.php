<?php

namespace Blog\Tests;

use PHPUnit\Framework\TestCase;
use Blog\Article;
use Blog\CommentAlreadyExistException;
use Carbon\Carbon;
use Tests\CommentBuilder;

class ArticleTest extends TestCase
{
    public const AUTHOR = "Pablo Escobar";
    private const COMMENT_TEXT = "Amazing article !!!";
    private Article $article;
    private CommentBuilder $commentBuilder;

    protected function setUp(): void
    {
        $this->article = new Article(
            "Lorem Ipsum",
            "consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore"
        );

        $this->commentBuilder = new CommentBuilder();
    }


    public function testShouldAddCommentInAnArticle(): void
    {
        $comment = $this->commentBuilder
            ->withText(self::COMMENT_TEXT)
            ->withAuthor(self::AUTHOR)
            ->build();

        $this->article->addComment($comment);

        $this->assertCount(1, $this->article->getComments());

        $retrievedComment = $this->article->getComments()[0];
        $this->assertEquals(self::COMMENT_TEXT, $retrievedComment->getText());
        $this->assertEquals(self::AUTHOR, $retrievedComment->getAuthor());
    }

    public function testShouldAddCommentInAnArticleContainingAlreadyAComment(): void
    {
        $firstComment = $this->commentBuilder
            ->withText(self::COMMENT_TEXT)
            ->withAuthor(self::AUTHOR)
            ->build();

        $newComment = "Finibus Bonorum et Malorum";
        $newAuthor = "Al Capone";
        $secondComment = $this->commentBuilder
            ->withText($newComment)
            ->withAuthor($newAuthor)
            ->build();

        $this->article->addComment($firstComment);
        $this->article->addComment($secondComment);

        $this->assertCount(2, $this->article->getComments());

        $lastComment = end($this->article->getComments());
        $this->assertEquals($newComment, $lastComment->getText());
        $this->assertEquals($newAuthor, $lastComment->getAuthor());
    }

    /**
     * @test
     */
    public function addingAnExistingCommentShouldFail(): void
    {
        $comment = $this->commentBuilder
            ->withText(self::COMMENT_TEXT)
            ->withAuthor(self::AUTHOR)
            ->build();

        $this->article->addComment($comment);

        $this->expectException(CommentAlreadyExistException::class);

        $this->article->addComment($comment);
    }
}
