<?php

namespace App\Transformers\Social;

use App\Contracts\Social\SocialFeedContract;
use League\Fractal\TransformerAbstract;

class SocialFeedTransformer extends TransformerAbstract
{

    public function transform(SocialFeedContract $feed)
    {
        return [
            'feed' => $this->setupFeed($feed),
        ];
    }

    public function setupFeed(SocialFeedContract $feed)
    {
        return Fractal()->collection($feed->getFeed(), new SocialFeedPostTransformer())->toArray();
        return $this->collection($feed->getFeed(), new SocialFeedPostTransformer()) ?: null;
    }
}
