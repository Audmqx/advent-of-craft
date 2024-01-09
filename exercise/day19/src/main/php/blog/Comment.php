<?php

namespace Blog;

use DateTimeImmutable;

class Comment
{
    public function __construct(
        public string $text,
        public string $author,
        public DateTimeImmutable $creationDate
    ) {
    }

    public function equals(Comment $other): bool
    {
        return $this->text === $other->text
            && $this->author === $other->author
            && $this->creationDate == $other->creationDate;
    }
}