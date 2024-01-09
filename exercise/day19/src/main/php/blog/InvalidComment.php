<?php

namespace Blog;

class InvalidComment
{
    public function __construct(public string $error)
    {}
}