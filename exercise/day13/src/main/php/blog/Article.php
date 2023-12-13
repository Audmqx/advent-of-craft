<?php

namespace Blog;

use Carbon\Carbon;

class Article
{
    private string $name;
    private string $content;
    private array $comments;

    public function __construct(string $name, string $content)
    {
        $this->name = $name;
        $this->content = $content;
        $this->comments = [];
    }

    private function addCommentPrivate(string $text, string $author, Carbon $creationDate): void
    {
        $newComment = new Comment($text, $author, $creationDate);

        $this->verifyExistingComment($newComment);

        $this->comments[] = $newComment;
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

    public function addComment(string $text, string $author): void
    {
        $this->addCommentPrivate($text, $author, Carbon::now());
    }

    public function getComments(): array
    {
        return $this->comments;
    }
}
