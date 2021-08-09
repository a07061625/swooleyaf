<?php
namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 *
 *
 * Request of GetMapUrl
 *
 * @method string getMapId()
 */
class GetMapUrlRequest extends RpcAcsRequest
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
            'cloudwf',
            '2017-03-28',
            'GetMapUrl',
            'cloudwf'
        );
    }

    /**
     * @param string $mapId
     *
     * @return $this
     */
    public function setMapId($mapId)
    {
        $this->requestParameters['MapId'] = $mapId;
        $this->queryParameters['MapId'] = $mapId;

        return $this;
    }
}
