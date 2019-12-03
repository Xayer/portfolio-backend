<?php

namespace App\Transformers\Social;

use App\Contracts\Social\SocialFeedContract;
use League\Fractal\TransformerAbstract;

class SocialFeedTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'feed'
    ];

    protected $availableIncludes = [
        'feed'
    ];

    public function transform(SocialFeedContract $feed) {
        return [];
    }

    public function includeFeed(SocialFeedContract $feed)
    {
        return $this->collection($feed->getFeed(), new SocialFeedPostTransformer()) ?: null;
    }
}
