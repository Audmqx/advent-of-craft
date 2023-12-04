<?php

use PHPUnit\Framework\TestCase;
use Carbon\Carbon;
use Blog\Article;
use Blog\CommentAlreadyExistException;

class ArticleTest extends TestCase
{
    const FIRST_ARTICLE = 0;
    private Article $article;

    public function setUp(): void
    {
        $this->article = new Article(
            "Lorem Ipsum",
            "consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore"
        );
    }

    public function test_application_should_throw_an_exception_when_user_add_an_existing_comment(): void
    {
        $this->article->addComment("Amazing article !!!", "Pablo Escobar");
        $this->expectException(CommentAlreadyExistException::class);
        $this->article->addComment("Amazing article !!!", "Pablo Escobar");
    }

    public function test_user_can_add_a_comment_to_an_article(): void
    {
        $author = "Pablo Escobar";
        $text = "Amazing article !!!";
        $this->article->addComment($text, $author);

        $this->assertNotEmpty($this->article->getComments());
        $this->assertNotNull($this->article->getComments()[self::FIRST_ARTICLE]);

        $firstComment = $this->article->getComments()[self::FIRST_ARTICLE];

        $this->assertSame($text, $firstComment->getText());
        $this->assertSame($author, $firstComment->getAuthor());
        $this->assertSame(Carbon::now()->day, $firstComment->getCreationDate()->day);
    }
}
