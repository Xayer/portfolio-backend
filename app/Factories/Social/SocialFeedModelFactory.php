<?php

namespace App\Factories\Social;

use App\Adapters\Social\Instagram\InstagramFeedAdapter;
use App\Factories\AbstractModelFactory;

class SocialFeedModelFactory extends AbstractModelFactory
{
    private $platform;
    protected $adapterMapping = [
        'instagram' => InstagramFeedAdapter::class,
    ];

    public function getAdapter($model)
    {
        return collect($this->adapterMapping)->each(function ($adapter) use ($model){
            if($model instanceof $adapter){
                return $adapter;
            }
        })->first();
    }
}
