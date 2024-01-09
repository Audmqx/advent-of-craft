<?php

namespace Blog;

use DateTimeImmutable;

class Article
{
    public function __construct(
        private string $name,
        private string $content,
        private array $comments = []
    ) {
    }

    private function addSafeComment(string $text, string $author, DateTimeImmutable $creationDate): Article
    {
        $comment = new Comment($text, $author, $creationDate);


        foreach ($this->comments as $existingComment) {
            if ($existingComment->equals($comment)) {
                throw new CommentAlreadyExistException();
            }
        }

        $newComments = $this->comments;
        $newComments[] = $comment;

        return new Article($this->name, $this->content, $newComments);
    }

    public function addComment(string $text, string $author): Article
    {
        return $this->addSafeComment($text, $author, new DateTimeImmutable());
    }

    public function getComments()
    {
        return $this->comments;
    }
}
