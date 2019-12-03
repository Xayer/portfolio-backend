<?php

namespace App\Transformers\Social;

use App\Adapters\Social\Instagram\InstagramImageAdapter;
use App\Contracts\Social\Instagram\Post;
use App\Contracts\Social\Instagram\PostContract;
use App\Models\Root\Image;
use App\Transformers\Root\AuthorTransformer;
use App\Transformers\Root\ImageColorTransformer;
use App\Transformers\Root\ImageTransformer;
use League\Fractal\TransformerAbstract;

class InstagramFeedPostTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'author',
        'images'
    ];
    protected $availableIncludes = [
        'author',
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
            'type' => $post->getType(),
        ];
    }

    public function includeImages(PostContract $post)
    {
        $images = $post->getImages()->transform(function ($image) {
            return new Image(new InstagramImageAdapter($image));
        });
        return $this->collection($images, new ImageTransformer());
    }

    public function includeAuthor(PostContract $post)
    {
        return $this->item($post->getAuthor(), new AuthorTransformer());
    }
}
