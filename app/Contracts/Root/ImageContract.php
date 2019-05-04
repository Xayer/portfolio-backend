<?php

namespace App\Contracts\Root;

interface ImageContract
{
    public function getUrl(): ?string;

    public function getWidth(): ?int;

    public function getHeight(): ?int;
}
