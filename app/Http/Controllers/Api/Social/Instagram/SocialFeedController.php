<?php

namespace App\Http\Controllers\Api\Social\Instagram;

use App\Adapters\Social\Instagram\InstagramFeedAdapter;
use App\Contracts\Repositories\SocialRepositoryContract;
use App\Controllers\Api\AbstractApiController;
use App\Controllers\Api\ApiControllerContract;
use App\Factories\Contracts\ModelFactoryContract;
use App\Factories\Social\SocialFeedModelFactory;
use App\Models\Social\SocialFeed;
use App\Transformers\Social\SocialFeedTransformer;
use Illuminate\Http\Request;

class SocialFeedController extends AbstractApiController
{
    protected $platform;
    protected $repository;

    protected $baseModelClass = SocialFeed::class;
    protected $transformerMapping = [
        'default' => SocialFeedTransformer::class,
    ];

    public function __construct(Request $request, string $platform, SocialRepositoryContract $repository)
    {
        $this->platform = $platform;
        $this->repository = $repository;
        parent::__construct($request);
    }

    public function getModelFactory(): ModelFactoryContract
    {
        return new SocialFeedModelFactory($this->baseModelClass, $this->repository);
    }

    public function setModel($model): ApiControllerContract
    {
        return parent::setModel($model);
    }
}
