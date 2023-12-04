<?php

namespace Blog;

use Carbon\Carbon;
use Blog\CommentAlreadyExistException;

class Article
{
    private array $comments;

    public function __construct(private string $name, private string $content)
    {
        $this->comments = [];
    }

    public function addComment(string $text, string $author): void
    {
        $this->addCommentToArticle($text, $author, Carbon::now());
    }

    private function addCommentToArticle(string $text, string $author, Carbon $creationDate): void
    {
        $comment = new Comment($text, $author, $creationDate);

        $this->verifyExistingComment($comment);

        $this->comments[] = $comment;
    }

    private function verifyExistingComment(Comment $comment)
    {
        foreach ($this->comments as $existingComment) {
            if (
                $existingComment->getText() === $comment->getText() &&
                $existingComment->getAuthor() === $comment->getAuthor()
            ) {
                throw new CommentAlreadyExistException();
            }
        }
    }

    public function getComments(): array
    {
        return $this->comments;
    }
}