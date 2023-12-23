<?php

namespace Blog;

use Carbon\Carbon;

class Article {
    private $name;
    private $content;
    private $comments;

    public function __construct($name, $content) {
        $this->name = $name;
        $this->content = $content;
        $this->comments = [];
    }

    private function addCommentSafely($text, $author, Carbon $creationDate) {
        $comment = new Comment($text, $author, $creationDate);

        if ($this->commentExists($comment)) {
            throw new CommentAlreadyExistException();
        } else {
            $this->comments[] = $comment;
        }
    }

    public function addComment($text, $author) {
        $this->addCommentSafely($text, $author, Carbon::now());
    }

    public function getComments() {
        return $this->comments;
    }

    private function commentExists($comment) {
        foreach ($this->comments as $existingComment) {
            if ($existingComment == $comment) {
                return true;
            }
        }
        return false;
    }
}

?>
