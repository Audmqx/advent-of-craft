<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use Blog\Article;
use Test\ArticleBuilder;
use Blog\Comment;

class ArticleTest extends TestCase
{
    private ?Article $article = null;

    protected function setUp(): void
    {
        parent::setUp();
        $this->article = null;
    }

    public function testShouldAddCommentInAnArticle()
    {
        // Arrange
        $this->article = ArticleBuilder::anArticle()->build();

        // Act
        $article = $this->article->addComment(ArticleBuilder::COMMENT_TEXT, ArticleBuilder::AUTHOR);

        // Assert
        $this->assertCount(1, $article->getComments());
        $this->assertComment($article->getComments()[0], ArticleBuilder::COMMENT_TEXT, ArticleBuilder::AUTHOR);
    }

    public function testShouldAddCommentInAnArticleContainingAlreadyAComment()
    {
        // Arrange
        $this->article = ArticleBuilder::anArticle()->commented()->build();

        $newComment = 'New Comment';
        $newAuthor = 'New Author';

        // Act
        $article = $this->article->addComment($newComment, $newAuthor);

        // Assert
        $this->assertCount(2, $article->getComments());
        $this->assertComment(end($article->getComments()), $newComment, $newAuthor);
    }

    public function testFailWhenAddingAnExistingComment()
    {
        // Arrange
        $this->article = ArticleBuilder::anArticle()->commented()->build();

        // Assert
        $this->expectException(CommentAlreadyExistException::class);

        // Act
        $this->article->addComment($this->article->getComments()[0]->text, $this->article->getComments()[0]->author);
    }

    private function assertComment(Comment $comment, string $commentText, string $author)
    {
        $this->assertEquals($commentText, $comment->text);
        $this->assertEquals($author, $comment->author);
    }
}
