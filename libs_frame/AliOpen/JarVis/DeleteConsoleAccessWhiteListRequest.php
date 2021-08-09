<?php

namespace AliOpen\JarVis;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteConsoleAccessWhiteList
 *
 * @method string getSourceIp()
 * @method string getLang()
 * @method string getDisableWhitelist()
 * @method string getSourceCode()
 */
class DeleteConsoleAccessWhiteListRequest extends RpcAcsRequest
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
        parent::__construct('jarvis', '2018-02-06', 'DeleteConsoleAccessWhiteList', 'jarvis');
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
     * @param string $disableWhitelist
     *
     * @return $this
     */
    public function setDisableWhitelist($disableWhitelist)
    {
        $this->requestParameters['DisableWhitelist'] = $disableWhitelist;
        $this->queryParameters['DisableWhitelist'] = $disableWhitelist;

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
