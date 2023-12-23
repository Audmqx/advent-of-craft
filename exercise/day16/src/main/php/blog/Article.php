<?php

namespace Blog;

use Carbon\Carbon;

class Article {

    public function __construct(private $name,private $content,private $comments = [])
    {}

    public function withComment(Comment $newComment)
    {
        if ($this->commentExists($newComment)) {
            throw new CommentAlreadyExistException();
        }

        $this->comments[] = $newComment;

        return new Article($this->name, $this->content, $this->comments);
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
