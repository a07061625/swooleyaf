<?php

namespace AliOpen\Cas;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CreateUnDeployment
 *
 * @method string getSourceIp()
 * @method string getDeploymentId()
 * @method string getLang()
 */
class CreateUnDeploymentRequest extends RpcAcsRequest
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
            'cas',
            '2018-08-13',
            'CreateUnDeployment',
            'cas_esign_fdd'
        );
    }

    /**
     * @param string $sourceIp
     *
     * @return $this
     */
    public function setSourceIp($sourceIp)
    {
        $this->requestParameters['SourceIp'] = $sourceIp;
        $this->queryParameters['SourceIp'] = $sourceIp;

        return $this;
    }

    /**
     * @param string $deploymentId
     *
     * @return $this
     */
    public function setDeploymentId($deploymentId)
    {
        $this->requestParameters['DeploymentId'] = $deploymentId;
        $this->queryParameters['DeploymentId'] = $deploymentId;

        return $this;
    }

    /**
     * @param string $lang
     *
     * @return $this
     */
    public function setLang($lang)
    {
        $this->requestParameters['Lang'] = $lang;
        $this->queryParameters['Lang'] = $lang;

        return $this;
    }
}
