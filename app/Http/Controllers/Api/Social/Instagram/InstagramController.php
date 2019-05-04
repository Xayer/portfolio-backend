<?php

namespace App\Http\Controllers\Api\Social\Instagram;

use App\Adapters\Social\Instagram\InstagramFeedAdapter;
use App\Controllers\Api\AbstractApiController;
use App\Controllers\Api\ApiControllerContract;
use App\Factories\Contracts\ModelFactoryContract;
use App\Factories\Social\SocialFeedModelFactory;
use App\Models\Social\SocialFeed;
use App\Repositories\InstagramRepository;
use App\Transformers\Social\SocialFeedTransformer;

class InstagramController extends AbstractApiController
{
    protected $baseModelClass = SocialFeed::class;
    protected $transformerMapping = [
        'default' => SocialFeedTransformer::class,
        //'teaser'  => SocialMediaTransformer::class
    ];

    public function getModelFactory(): ModelFactoryContract
    {
        return new SocialFeedModelFactory($this->baseModelClass, new InstagramRepository());
    }

    public function setModel($model): ApiControllerContract
    {
        return parent::setModel($model);
    }
}
