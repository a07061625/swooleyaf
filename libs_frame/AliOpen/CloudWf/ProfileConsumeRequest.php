<?php

namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ProfileConsume
 *
 * @method string getBeginDate()
 * @method string getEndDate()
 * @method string getDataType()
 * @method string getGsid()
 */
class ProfileConsumeRequest extends RpcAcsRequest
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
            'ProfileConsume',
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
     * @param string $dataType
     *
     * @return $this
     */
    public function setDataType($dataType)
    {
        $this->requestParameters['DataType'] = $dataType;
        $this->queryParameters['DataType'] = $dataType;

        return $this;
    }

    /**
     * @param string $gsid
     *
     * @return $this
     */
    public function setGsid($gsid)
    {
        $this->requestParameters['Gsid'] = $gsid;
        $this->queryParameters['Gsid'] = $gsid;

        return $this;
    }
}
