<?php

namespace App\Controllers\Api;

interface ApiControllerContract
{
    public function setModel($model): ApiControllerContract;

    public function getResponse();

    public function getTransformer();

    public function getModelFactory();
}
