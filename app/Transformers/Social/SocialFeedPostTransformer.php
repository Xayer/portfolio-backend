<?php

namespace App\Transformers\Social;

use App\Adapters\Root\ImageAdapter;
use App\Adapters\Social\Instagram\InstagramImageAdapter;
use App\Contracts\Social\Instagram\Post;
use App\Contracts\Social\Instagram\PostContract;
use App\Models\Root\Image;
use App\Transformers\Root\ImageTransformer;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Spatie\Fractal\Facades\Fractal;

class SocialFeedPostTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'images'
    ];
    protected $availableIncludes = [
        'images'
    ];
    public function transform(PostContract $post)
    {
        return [
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'created_time' => $post->getCreatedTime(),
            'caption' => $post->getCaption(),
            'link' => $post->getLink(),
            'likes' => $post->getLikes(),
            'filter' => $post->getFilter(),
            'author' => $post->getAuthor(),
            'type' => $post->getType(),
        ];
    }

    public function includeImages(PostContract $post)
    {
        $images = $post->getImages()->transform(function($image){
            return new Image(new InstagramImageAdapter($image));
        });
        return $this->collection($images, new ImageTransformer());
    }
}
