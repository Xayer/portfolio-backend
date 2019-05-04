<?php

namespace App\Adapters\Social\Instagram;

use App\Adapters\Root\ImageAdapter;
use App\Contracts\Root\AuthorContract;
use App\Contracts\Root\ImageContract;
use App\Models\Root\Image;

class InstagramAuthorAdapter implements AuthorContract
{

    private $author;

    public function __construct($author)
    {
        $this->author = $author;
    }

    public function getId(): ?int
    {
        return $this->author->id;
    }

    public function getFullName(): ?string
    {
        return $this->author->full_name;
    }

    public function getProfilePicture(): ?ImageContract
    {
        return new Image(new ImageAdapter($this->author->profile_picture)) ?: null;
    }

    public function getUsername(): string
    {
        return $this->author->username;
    }
}
