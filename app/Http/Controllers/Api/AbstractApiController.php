<?php

namespace App\Controllers\Api;

use App\Exceptions\Controllers\Api\BaseModelMissingException;
use App\Exceptions\Controllers\Api\InvalidFormatException;
use App\Exceptions\Controllers\Api\TransformerMappingMissingException;
use App\Factories\Contracts\ModelFactoryContract;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use League\Fractal\Manager;
use Spatie\Fractal\Facades\Fractal;

abstract class AbstractApiController implements ApiControllerContract
{
    const INCLUDES_QUERY_PARAM = 'with';
    const EXCLUDES_QUERY_PARAM = 'without';
    const FORMAT_QUERY_PARAM = 'format';

    protected $fractal;
    protected $response;
    protected $model;
    protected $meta;
    protected $request;
    /* @var array must at least have a default => SomeTransformer::class for the given controller */
    protected $transformerMapping = [];
    /* @var mixed should be set to the default base model::class for the given controller */
    protected $baseModelClass;

    /**
     * AbstractApiController constructor.
     *
     * @param Request        $request
     *
     * @throws TransformerMappingMissingException
     * @throws BaseModelMissingException
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        if (empty($this->transformerMapping) || ! isset($this->transformerMapping['default'])) {
            throw new TransformerMappingMissingException(
                sprintf('Missing "default" transformer in $transformerMapping on class: %s', static::class)
            );
        }
        if (empty($this->baseModelClass)) {
            throw new BaseModelMissingException(
                sprintf('Missing $baseModelClass on class: %s', static::class)
            );
        }
    }

    /**
     */
    public function getModelFactory(): ModelFactoryContract
    {
        return new $this->baseModelClass;
    }

    /**
     * @param $model
     *
     * @return ApiControllerContract
     */
    public function setModel($model): ApiControllerContract
    {
        $this->model = $this->getModelFactory()->getModel($model);
        return $this;
    }

    public function getResponse()
    {
        $this->validateFormat();
        $manager = new Manager();
        $manager->parseIncludes($this->request->query(static::INCLUDES_QUERY_PARAM) ?? '');
        $manager->parseExcludes($this->request->query(static::EXCLUDES_QUERY_PARAM) ?? '');
        $item = Fractal::item($this->model, $this->getTransformer())
            ->createData()
            ->toArray();

        return response()->json($item);
    }

    public function getTransformer()
    {

        $format = $this->request->query(static::FORMAT_QUERY_PARAM);
        $transformerClass = collect($this->transformerMapping)->get(
            $format,
            collect($this->transformerMapping)->get('default')
        );

        return new $transformerClass();
    }

    private function validateFormat()
    {
        $format = $this->request->query(static::FORMAT_QUERY_PARAM);
        if (! collect($this->transformerMapping)->get($format) && ! empty($format)) {
            $errorMsg = sprintf(
                'Invalid format provided: %s, valid formats are: %s',
                $format,
                json_encode(array_keys($this->transformerMapping))
            );
            throw new InvalidFormatException($errorMsg, 422);
        }
    }
}
