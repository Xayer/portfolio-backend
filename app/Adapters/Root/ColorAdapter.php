<?php

namespace App\Adapters\Root;

use App\Contracts\Root\ColorContract;

class ColorAdapter implements ColorContract
{
    protected $color;
    public function __construct(string $color)
    {
        $this->color = $color;
    }

    public function getHex(): ?string
    {
        return $this->color;
    }
}
