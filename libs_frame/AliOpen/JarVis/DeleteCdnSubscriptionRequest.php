<?php

namespace AliOpen\JarVis;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteCdnSubscription
 *
 * @method string getSourceIp()
 * @method string getLang()
 * @method string getCdnUidList()
 * @method string getSourceCode()
 */
class DeleteCdnSubscriptionRequest extends RpcAcsRequest
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
        parent::__construct('jarvis', '2018-02-06', 'DeleteCdnSubscription', 'jarvis');
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

    /**
     * @param string $cdnUidList
     *
     * @return $this
     */
    public function setCdnUidList($cdnUidList)
    {
        $this->requestParameters['CdnUidList'] = $cdnUidList;
        $this->queryParameters['CdnUidList'] = $cdnUidList;

        return $this;
    }

    /**
     * @param string $sourceCode
     *
     * @return $this
     */
    public function setSourceCode($sourceCode)
    {
        $this->requestParameters['SourceCode'] = $sourceCode;
        $this->queryParameters['SourceCode'] = $sourceCode;

        return $this;
    }
}
