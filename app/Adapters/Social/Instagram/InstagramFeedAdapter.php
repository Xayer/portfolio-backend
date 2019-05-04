<?php

namespace App\Adapters\Social\Instagram;

use App\Contracts\Social\SocialFeedContract;
use App\Models\Social\SocialPost;
use Illuminate\Support\Collection;


class InstagramFeedAdapter implements SocialFeedContract
{
    protected $repo;
    public function __construct($repo)
    {
        $this->repo = $repo;
    }

    public function getFeed(): ?Collection
    {
        return collect($this->repo->getRecentPosts())->transform(function($post){
            return new SocialPost(new PostAdapter($post));
        });
    }
}
