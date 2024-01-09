<?php

namespace Blog;

use DateTimeImmutable;
use Innmind\Immutable\Either;

class Article
{
    public function __construct(
        private string $name,
        private string $content,
        private array $comments = []
    ) {
    }

    private function addSafeComment(string $text, string $author, DateTimeImmutable $creationDate): Either
    {
        $comment = new Comment($text, $author, $creationDate);

        foreach ($this->comments as $existingComment) {
            if ($existingComment->equals($comment)) {
                return Either::left(new InvalidComment('existing comment'));
            }
        }

        $newComments = $this->comments;
        $newComments[] = $comment;

        return Either::right(new Article($this->name, $this->content, $newComments));
    }

    public function addComment(string $text, string $author): Either
    {
        return $this->addSafeComment($text, $author, new DateTimeImmutable());
    }

    public function getComments()
    {
        return $this->comments;
    }
}
