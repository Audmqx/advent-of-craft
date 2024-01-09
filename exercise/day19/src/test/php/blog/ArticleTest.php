<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use Blog\Article;
use Test\ArticleBuilder;
use Blog\Comment;
use Innmind\Immutable\Either;

class ArticleTest extends TestCase
{
    private $article = null;

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
        $eitherArticle = $this->article->addComment(ArticleBuilder::COMMENT_TEXT, ArticleBuilder::AUTHOR);

        // Arrange
        $eitherArticle->map( function($article) {
            $this->assertCount(1, $article->getComments());
            $this->assertComment($article->getComments()[0], ArticleBuilder::COMMENT_TEXT, ArticleBuilder::AUTHOR);
        });
    }

    public function testShouldAddCommentInAnArticleContainingAlreadyAComment()
    {
        // Arrange
        $this->article = ArticleBuilder::anArticle()->commented()->build();

        // Act | Assert
        $this->article->flatMap(function($article){
            return $article->addComment('New Comment', 'New Author');
        })->map(function($commentedTwice){
            $this->assertCount(2, $commentedTwice->getComments());
            $this->assertComment(end($commentedTwice->getComments()), 'New Comment','New Author');
        });
    }

    public function testFailWhenAddingAnExistingComment()
    {
        // Arrange
        $this->article = ArticleBuilder::anArticle()->commented()->build();

 
        // Act
        $commentedTwice = $this->article->flatMap(function($article) {
            return $article->addComment($article->getComments()[0]->text, $article->getComments()[0]->author);
        });

  
        $response = $commentedTwice->match(
            function($right){
                //will return Either::right if exist
                return $right;
            },
            function($left){
                 //will return Either::left if exist
                return $left;
            });

 
        // Assert
        $this->assertSame($response->error, "existing comment");
    }

    private function assertComment(Comment $comment, string $commentText, string $author)
    {
        $this->assertEquals($commentText, $comment->text);
        $this->assertEquals($author, $comment->author);
    }
}
