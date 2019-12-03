<?php

namespace App\Contracts\Root;

use Illuminate\Support\Collection;

interface ImageContract
{
    public function getUrl(): ?string;

    public function getWidth(): ?int;

    public function getHeight(): ?int;

    public function getColors(): ?Collection;
}
