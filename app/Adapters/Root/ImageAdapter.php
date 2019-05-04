<?php

namespace App\Adapters\Root;

use App\Contracts\Root\ImageContract;

class ImageAdapter implements ImageContract
{
    protected $url;
    public function __construct($url)
    {
        $this->url = $url;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getWidth(): ?int
    {
        return null;
    }

    public function getHeight(): ?int
    {
        return null;
    }
}
