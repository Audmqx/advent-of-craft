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

    public function addComment(Comment $comment): void
    {
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
