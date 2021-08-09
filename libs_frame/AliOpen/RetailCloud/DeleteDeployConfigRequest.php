<?php

namespace AliOpen\RetailCloud;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteDeployConfig
 *
 * @method string getSchemaId()
 */
class DeleteDeployConfigRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('retailcloud', '2018-03-13', 'DeleteDeployConfig', 'retailcloud');
    }

    /**
     * @param string $schemaId
     *
     * @return $this
     */
    public function setSchemaId($schemaId)
    {
        $this->requestParameters['SchemaId'] = $schemaId;
        $this->queryParameters['SchemaId'] = $schemaId;

        return $this;
    }
}
