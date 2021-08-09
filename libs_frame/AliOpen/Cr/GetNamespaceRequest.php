<?php

namespace AliOpen\Cr;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetNamespace
 *
 * @method string getNamespaceName()
 * @method string getInstanceId()
 * @method string getNamespaceId()
 */
class GetNamespaceRequest extends RpcAcsRequest
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
        parent::__construct(
            'cr',
            '2018-12-01',
            'GetNamespace',
            'acr'
        );
    }

    /**
     * @param string $namespaceName
     *
     * @return $this
     */
    public function setNamespaceName($namespaceName)
    {
        $this->requestParameters['NamespaceName'] = $namespaceName;
        $this->queryParameters['NamespaceName'] = $namespaceName;

        return $this;
    }

    /**
     * @param string $instanceId
     *
     * @return $this
     */
    public function setInstanceId($instanceId)
    {
        $this->requestParameters['InstanceId'] = $instanceId;
        $this->queryParameters['InstanceId'] = $instanceId;

        return $this;
    }

    /**
     * @param string $namespaceId
     *
     * @return $this
     */
    public function setNamespaceId($namespaceId)
    {
        $this->requestParameters['NamespaceId'] = $namespaceId;
        $this->queryParameters['NamespaceId'] = $namespaceId;

        return $this;
    }
}
