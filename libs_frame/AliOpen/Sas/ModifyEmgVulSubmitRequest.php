<?php

namespace AliOpen\Sas;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ModifyEmgVulSubmit
 *
 * @method string getSourceIp()
 * @method string getName()
 * @method string getUserAgreement()
 * @method string getLang()
 */
class ModifyEmgVulSubmitRequest extends RpcAcsRequest
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
        parent::__construct('Sas', '2018-12-03', 'ModifyEmgVulSubmit', 'sas');
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
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->requestParameters['Name'] = $name;
        $this->queryParameters['Name'] = $name;

        return $this;
    }

    /**
     * @param string $userAgreement
     *
     * @return $this
     */
    public function setUserAgreement($userAgreement)
    {
        $this->requestParameters['UserAgreement'] = $userAgreement;
        $this->queryParameters['UserAgreement'] = $userAgreement;

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
