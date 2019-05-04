<?php

namespace App\Models\Social;

use App\Contracts\Social\SocialFeedContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SocialFeed extends Model implements SocialFeedContract
{
    protected $socialFeed;

    public function __construct(SocialFeedContract $socialFeed)
    {
        $this->socialFeed = $socialFeed;
    }

    public function getFeed(): ?Collection
    {
        return $this->socialFeed->getFeed();
    }
}
