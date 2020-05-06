<?php
namespace AliOpen\Cdn;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteRealtimeLogDelivery
 * @method string getProject()
 * @method string getOwnerId()
 * @method string getDomain()
 * @method string getRegion()
 * @method string getLogstore()
 */
class RealtimeLogDeliveryDeleteRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Cdn', '2018-05-10', 'DeleteRealtimeLogDelivery');
    }

    /**
     * @param string $project
     * @return $this
     */
    public function setProject($project)
    {
        $this->requestParameters['Project'] = $project;
        $this->queryParameters['Project'] = $project;

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

    /**
     * @param string $domain
     * @return $this
     */
    public function setDomain($domain)
    {
        $this->requestParameters['Domain'] = $domain;
        $this->queryParameters['Domain'] = $domain;

        return $this;
    }

    /**
     * @param string $region
     * @return $this
     */
    public function setRegion($region)
    {
        $this->requestParameters['Region'] = $region;
        $this->queryParameters['Region'] = $region;

        return $this;
    }

    /**
     * @param string $logstore
     * @return $this
     */
    public function setLogstore($logstore)
    {
        $this->requestParameters['Logstore'] = $logstore;
        $this->queryParameters['Logstore'] = $logstore;

        return $this;
    }
}
