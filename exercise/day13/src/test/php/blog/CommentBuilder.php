<?php


namespace Tests;

use Blog\Comment;
use Carbon\Carbon;

class CommentBuilder
{
    private string $text = "Default Comment Text";
    private string $author = "Default Author";
    private Carbon $creationDate;

    public function withText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    public function withAuthor(string $author): self
    {
        $this->author = $author;
        return $this;
    }

    public function withCreationDate(Carbon $creationDate): self
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    public function build(): Comment
    {
        // Si $creationDate n'est pas initialisé, utilisez la date actuelle par défaut
        $this->creationDate ??= Carbon::now();

        return new Comment($this->text, $this->author, $this->creationDate);
    }
}
