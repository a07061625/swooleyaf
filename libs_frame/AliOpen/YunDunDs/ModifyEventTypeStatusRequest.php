<?php

namespace AliOpen\YunDunDs;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ModifyEventTypeStatus
 * @method string getSubTypeIds()
 * @method string getSourceIp()
 * @method string getLang()
 */
class ModifyEventTypeStatusRequest extends RpcAcsRequest
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
        parent::__construct('Yundun-ds', '2019-01-03', 'ModifyEventTypeStatus', 'sddp');
    }

    /**
     * @param string $subTypeIds
     * @return $this
     */
    public function setSubTypeIds($subTypeIds)
    {
        $this->requestParameters['SubTypeIds'] = $subTypeIds;
        $this->queryParameters['SubTypeIds'] = $subTypeIds;

        return $this;
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
     * @param string $lang
     * @return $this
     */
    public function setLang($lang)
    {
        $this->requestParameters['Lang'] = $lang;
        $this->queryParameters['Lang'] = $lang;

        return $this;
    }
}
