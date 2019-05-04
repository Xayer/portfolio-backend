<?php

namespace App\Contracts\Root;

interface AuthorContract
{
    public function getId(): ?int;

    public function getFullName(): ?string;

    public function getProfilePicture(): ?ImageContract;

    public function getUsername(): string;
}
