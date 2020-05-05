<?php
namespace AliOpen\Afs;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ConfigurationStyle
 * @method string getSourceIp()
 * @method string getConfigurationMethod()
 * @method string getRefExtId()
 * @method string getApplyType()
 * @method string getScene()
 */
class StyleConfigurationRequest extends RpcAcsRequest
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
        parent::__construct('afs', '2018-01-12', 'ConfigurationStyle', 'afs');
    }

    /**
     * @param string $sourceIp
     * @return $this
     */
    public function setSourceIp($sourceIp)
    {
        $this->requestParameters['SourceIp'] = $sourceIp;
        $this->queryParameters['SourceIp'] = $sourceIp;

        return $this;
    }

    /**
     * @param string $configurationMethod
     * @return $this
     */
    public function setConfigurationMethod($configurationMethod)
    {
        $this->requestParameters['ConfigurationMethod'] = $configurationMethod;
        $this->queryParameters['ConfigurationMethod'] = $configurationMethod;

        return $this;
    }

    /**
     * @param string $refExtId
     * @return $this
     */
    public function setRefExtId($refExtId)
    {
        $this->requestParameters['RefExtId'] = $refExtId;
        $this->queryParameters['RefExtId'] = $refExtId;

        return $this;
    }

    /**
     * @param string $applyType
     * @return $this
     */
    public function setApplyType($applyType)
    {
        $this->requestParameters['ApplyType'] = $applyType;
        $this->queryParameters['ApplyType'] = $applyType;

        return $this;
    }

    /**
     * @param string $scene
     * @return $this
     */
    public function setScene($scene)
    {
        $this->requestParameters['Scene'] = $scene;
        $this->queryParameters['Scene'] = $scene;

        return $this;
    }
}
