<?php

namespace App\Http\Controllers\Api\Social;

use App\Adapters\Social\Instagram\InstagramFeedAdapter;
use App\Controllers\Api\ApiControllerContract;
use App\Http\Controllers\Api\Social\Instagram\InstagramController;
use App\Models\Social\SocialFeed;
use App\Repositories\InstagramRepository;
use App\Services\InstagramService;
use Illuminate\Http\Request;

class SocialController
{
    protected $platformMapping = [
        'instagram' => InstagramController::class
    ];
    public function detectPlatform(string $platform, Request $request)
    {
        if (array_key_exists($platform, $this->platformMapping)) {
            $controller = $this->platformMapping[$platform];
            $model = new InstagramRepository();
            return $this->getControllerInstance($controller, $request)->setModel($model)->getResponse();
        }
        return response()->json()->setStatusCode(404);
    }

    /**
     * @param $controller
     * @param Request $request
     *
     * @return ApiControllerContract
     */
    private function getControllerInstance(
        $controller,
        Request $request
    ): ApiControllerContract {
        return new $controller($request);
    }
}
