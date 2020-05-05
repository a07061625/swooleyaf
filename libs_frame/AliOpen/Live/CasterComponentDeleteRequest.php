<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteCasterComponent
 * @method string getComponentId()
 * @method string getCasterId()
 * @method string getOwnerId()
 */
class CasterComponentDeleteRequest extends RpcAcsRequest
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
        parent::__construct('live', '2016-11-01', 'DeleteCasterComponent', 'live');
    }

    /**
     * @param string $componentId
     * @return $this
     */
    public function setComponentId($componentId)
    {
        $this->requestParameters['ComponentId'] = $componentId;
        $this->queryParameters['ComponentId'] = $componentId;

        return $this;
    }

    /**
     * @param string $casterId
     * @return $this
     */
    public function setCasterId($casterId)
    {
        $this->requestParameters['CasterId'] = $casterId;
        $this->queryParameters['CasterId'] = $casterId;

        return $this;
    }

    /**
     * @param string $ownerId
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->requestParameters['OwnerId'] = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;

        return $this;
    }
}
