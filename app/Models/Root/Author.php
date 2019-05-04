<?php

namespace App\Models\Root;

use App\Contracts\Root\AuthorContract;
use App\Contracts\Root\ImageContract;

class Author implements AuthorContract
{
    protected $author;

    public function __construct(AuthorContract $author)
    {
        $this->author = $author;
    }

    public function getId(): ?int
    {
        return $this->author->getId();
    }

    public function getFullName(): ?string
    {
        return $this->author->getFullName();
    }

    public function getProfilePicture(): ?ImageContract
    {
        return $this->author->getProfilePicture();
    }

    public function getUsername(): string
    {
        return $this->author->getUsername();
    }
}

