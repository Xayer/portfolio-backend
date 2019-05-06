<?php

namespace App\Models\Root;

use App\Contracts\Root\ColorContract;
use Illuminate\Support\Collection;

class Color implements ColorContract
{
    protected $color;

    public function __construct(ColorContract $color)
    {
        $this->color = $color;
    }

    public function getHex(): ?string
    {
        return $this->color->getHex();
    }
}

