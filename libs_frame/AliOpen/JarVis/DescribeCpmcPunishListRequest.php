<?php

namespace AliOpen\JarVis;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeCpmcPunishList
 *
 * @method string getSrcIP()
 * @method string getSourceIp()
 * @method string getpageSize()
 * @method string getcurrentPage()
 * @method string getPunishStatus()
 * @method string getLang()
 * @method string getSourceCode()
 */
class DescribeCpmcPunishListRequest extends RpcAcsRequest
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
        parent::__construct('jarvis', '2018-02-06', 'DescribeCpmcPunishList', 'jarvis');
    }

    /**
     * @param string $srcIP
     *
     * @return $this
     */
    public function setSrcIP($srcIP)
    {
        $this->requestParameters['SrcIP'] = $srcIP;
        $this->queryParameters['SrcIP'] = $srcIP;

        return $this;
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
     * @param string $pageSize
     *
     * @return $this
     */
    public function setpageSize($pageSize)
    {
        $this->requestParameters['pageSize'] = $pageSize;
        $this->queryParameters['pageSize'] = $pageSize;

        return $this;
    }

    /**
     * @param string $currentPage
     *
     * @return $this
     */
    public function setcurrentPage($currentPage)
    {
        $this->requestParameters['currentPage'] = $currentPage;
        $this->queryParameters['currentPage'] = $currentPage;

        return $this;
    }

    /**
     * @param string $punishStatus
     *
     * @return $this
     */
    public function setPunishStatus($punishStatus)
    {
        $this->requestParameters['PunishStatus'] = $punishStatus;
        $this->queryParameters['PunishStatus'] = $punishStatus;

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
