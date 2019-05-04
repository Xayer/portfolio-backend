<?php

namespace App\Contracts\Social;

use Illuminate\Support\Collection;

interface SocialFeedContract
{
    public function getFeed(): ?Collection;
}
