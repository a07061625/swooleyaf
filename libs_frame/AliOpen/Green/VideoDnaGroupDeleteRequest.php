<?php
namespace AliOpen\Green;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of DeleteVideoDnaGroup
 * @method string getClientInfo()
 */
class VideoDnaGroupDeleteRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/green/video/dna/group/delete';
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Green', '2018-05-09', 'DeleteVideoDnaGroup', 'green');
    }

    /**
     * @param string $clientInfo
     * @return $this
     */
    public function setClientInfo($clientInfo)
    {
        $this->requestParameters['ClientInfo'] = $clientInfo;
        $this->queryParameters['ClientInfo'] = $clientInfo;

        return $this;
    }
}
