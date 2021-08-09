<?php

namespace AliOpen\Ehpc;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ModifyContainerAppAttributes
 *
 * @method string getDescription()
 * @method string getContainerId()
 */
class ModifyContainerAppAttributesRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('EHPC', '2018-04-12', 'ModifyContainerAppAttributes', 'ehs');
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->requestParameters['Description'] = $description;
        $this->queryParameters['Description'] = $description;

        return $this;
    }

    /**
     * @param string $containerId
     *
     * @return $this
     */
    public function setContainerId($containerId)
    {
        $this->requestParameters['ContainerId'] = $containerId;
        $this->queryParameters['ContainerId'] = $containerId;

        return $this;
    }
}
