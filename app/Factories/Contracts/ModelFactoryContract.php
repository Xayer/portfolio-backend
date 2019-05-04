<?php

namespace App\Factories\Contracts;

interface ModelFactoryContract
{
    public function getModel($model);

    public function getAdapter($model);
}
