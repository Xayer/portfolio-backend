<?php

namespace App\Adapters\Social\Instagram;

use App\Contracts\Root\ImageContract;

class InstagramImageAdapter implements ImageContract
{
    private $image;
    public function __construct($image)
    {
        $this->image = $image;
    }

    public function getUrl(): string
    {
        return $this->image->url;
    }

    public function getWidth(): ?int
    {
        return $this->image->width;
    }

    public function getHeight(): ?int
    {
        return $this->image->height;
    }
}
