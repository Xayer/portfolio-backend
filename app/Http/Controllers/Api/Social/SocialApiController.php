<?php

namespace App\Http\Controllers\Api\Social;

use App\Adapters\Social\Instagram\InstagramFeedAdapter;
use App\Controllers\Api\AbstractApiController;
use App\Controllers\Api\ApiControllerContract;
use App\Factories\Contracts\ModelFactoryContract;
use App\Http\Controllers\Api\Social\Instagram\SocialFeedController;
use App\Models\Social\SocialFeed;
use App\Repositories\InstagramRepository;
use App\Contracts\Repositories\RepositoryContract;
use App\Services\InstagramService;
use Illuminate\Http\Request;

class SocialApiController extends AbstractApiController
{
    protected $baseModelClass = SocialFeed::class;
    protected $controllerMapping = [
        'instagram' => SocialFeedController::class
    ];
    protected $repositoryMapping = [
        'instagram' => InstagramRepository::class
    ];
    protected $transformerMapping = [
        'default' => SocialFeedTransformer::class,
    ];

    protected $apiControllerMapping = [
        'feed' => SocialFeedController::class
    ];

    public function view(string $platform, string $type, Request $request)
    {
        $this->detectPlatform($platform, $type, $request);
    }

    public function detectPlatform(string $platform, string $type, Request $request)
    {
        if (!array_key_exists($platform, $this->repositoryMapping)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Invalid Repository provided: "%s", valid formats are: %s',
                    $platform,
                    json_encode(array_keys($this->repositoryMapping))
                ),
                422
            );
        }

        if (!array_key_exists($type, $this->apiControllerMapping)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Invalid Controller provided: "%s", valid formats are: %s',
                    $type,
                    json_encode(array_keys($this->apiControllerMapping))
                ),
                422
            );
        }

        $model = new $this->repositoryMapping[$platform];
        $controller = $this->apiControllerMapping[$type];
        $repository = new $this->repositoryMapping[$platform];
        return $this->getControllerInstance($controller, $request, $platform, $repository)->setModel($model)->getResponse();
    }

    /**
     * @param $controller
     * @param Request $request
     * @param string $platform
     * @param RepositoryContract $repository
     * @return ApiControllerContract
     */
    private function getControllerInstance(
        $controller,
        Request $request,
        string $platform,
        RepositoryContract $repository
    ): ApiControllerContract {
        return new $controller($request, $platform, $repository);
    }
}
