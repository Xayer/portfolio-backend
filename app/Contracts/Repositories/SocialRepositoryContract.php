<?php

namespace App\Contracts\Repositories;

use Illuminate\Support\Collection;

interface SocialRepositoryContract
{
    public function getRecentPosts(): ?Collection;
}
