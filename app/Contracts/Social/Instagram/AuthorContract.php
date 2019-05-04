<?php

namespace App\Contracts\Social\Instagram;

use App\Contracts\ImageContract;

interface Author
{
    public function getId(): ?int;

    public function getFullName(): ?string;

    public function getProfilePicture(): ?ImageContract;

    public function getUsername(): string;
}
