<?php

namespace App\Factories;

use App\Exceptions\Controllers\Api\MissingAdapterException;
use App\Exceptions\Controllers\Api\OverrideModelMissingContractException;
use App\Factories\Contracts\ModelFactoryContract;


abstract class AbstractModelFactory implements ModelFactoryContract
{
    protected $baseClass;
    protected $adapterMapping;

    /**
     * ModelFactory constructor.
     *
     * @param $baseClass
     */
    public function __construct($baseClass)
    {
        $this->baseClass = $baseClass;
    }

    /**
     * @param mixed $baseClass
     *
     * @return ModelFactoryContract
     */
    public function setBaseClass($baseClass): ModelFactoryContract
    {
        $this->baseClass = $baseClass;
        return $this;
    }

    /**
     * @param $model
     *
     * @return mixed
     * @throws OverrideModelMissingContractException
     * @throws MissingAdapterException
     */
    public function getModel($model)
    {
        $adapter = $this->getAdapter($model);
        $baseModel = new $this->baseClass($this->instantiateAdapter($adapter, $model));
        return $baseModel;
    }

    /**
     * @param $adapter
     * @param $model
     *
     * @return mixed
     *
     * @throws MissingAdapterException
     */
    protected function instantiateAdapter($adapter, $model)
    {
        if (!$adapter || !class_exists($adapter)) {
            throw new MissingAdapterException(sprintf('The adapter class \'%s\' does not exist', $adapter));
        }
        return new $adapter($model);
    }
}
