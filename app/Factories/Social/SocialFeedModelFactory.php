<?php

namespace App\Factories\Social;

use App\Adapters\Social\Instagram\InstagramFeedAdapter;
use App\Contracts\Repositories\SocialRepositoryContract;
use App\Factories\AbstractModelFactory;

class SocialFeedModelFactory extends AbstractModelFactory
{

    protected $repository;
    protected $adapterMapping = [
        'instagram' => InstagramFeedAdapter::class,
    ];

    public function __construct($baseClass, SocialRepositoryContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($baseClass);
    }

    public function getAdapter($model)
    {
        return collect($this->adapterMapping)->each(function ($adapter) use ($model) {
            if ($model instanceof $adapter) {
                return $adapter;
            }
        })->first();
    }
}
