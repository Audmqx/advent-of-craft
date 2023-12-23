<?php

namespace Blog;

use Carbon\Carbon;

class Comment {
    public $text;
    public $author;
    public $creationDate;

    public function __construct($text, $author, Carbon $creationDate) {
        $this->text = $text;
        $this->author = $author;
        $this->creationDate = $creationDate;
    }
}

?>
