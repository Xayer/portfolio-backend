<?php

namespace App\Models\Instagram;

use App\Models\Social\SocialPost;

class Post extends SocialPost
{
    protected $post;
    protected $table = 'instagram_posts';

    protected $attributes = [
        'id',
        'created',
        'caption',
        'url',
        'images',
        'type',
        'original_request'
    ];
}
