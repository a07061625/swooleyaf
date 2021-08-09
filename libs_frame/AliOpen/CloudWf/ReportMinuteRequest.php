<?php
namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 *
 *
 * Request of ReportMinute
 *
 * @method string getBeginDate()
 * @method string getEndDate()
 * @method string getAgsid()
 */
class ReportMinuteRequest extends RpcAcsRequest
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
            'cloudwf',
            '2017-03-28',
            'ReportMinute',
            'cloudwf'
        );
    }

    /**
     * @param string $beginDate
     *
     * @return $this
     */
    public function setBeginDate($beginDate)
    {
        $this->requestParameters['BeginDate'] = $beginDate;
        $this->queryParameters['BeginDate'] = $beginDate;

        return $this;
    }

    /**
     * @param string $endDate
     *
     * @return $this
     */
    public function setEndDate($endDate)
    {
        $this->requestParameters['EndDate'] = $endDate;
        $this->queryParameters['EndDate'] = $endDate;

        return $this;
    }

    /**
     * @param string $agsid
     *
     * @return $this
     */
    public function setAgsid($agsid)
    {
        $this->requestParameters['Agsid'] = $agsid;
        $this->queryParameters['Agsid'] = $agsid;

        return $this;
    }
}
