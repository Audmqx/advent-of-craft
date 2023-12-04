<?php

namespace Blog;

use Carbon\Carbon;

class Comment
{

    public function __construct(private string $text, private string $author,private Carbon $creationDate)
    {}

    public function getText(): string
    {
        return $this->text;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getCreationDate(): Carbon
    {
        return $this->creationDate;
    }
}
