<?php

namespace AliOpen\Sas;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeAlarmEventDetail
 *
 * @method string getAlarmUniqueInfo()
 * @method string getSourceIp()
 * @method string getFrom()
 * @method string getLang()
 */
class DescribeAlarmEventDetailRequest extends RpcAcsRequest
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
        parent::__construct('Sas', '2018-12-03', 'DescribeAlarmEventDetail', 'sas');
    }

    /**
     * @param string $alarmUniqueInfo
     *
     * @return $this
     */
    public function setAlarmUniqueInfo($alarmUniqueInfo)
    {
        $this->requestParameters['AlarmUniqueInfo'] = $alarmUniqueInfo;
        $this->queryParameters['AlarmUniqueInfo'] = $alarmUniqueInfo;

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
     * @param string $from
     *
     * @return $this
     */
    public function setFrom($from)
    {
        $this->requestParameters['From'] = $from;
        $this->queryParameters['From'] = $from;

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
