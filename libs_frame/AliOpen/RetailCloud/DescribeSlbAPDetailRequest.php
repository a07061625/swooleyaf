<?php

namespace AliOpen\RetailCloud;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeSlbAPDetail
 *
 * @method string getSlbAPId()
 */
class DescribeSlbAPDetailRequest extends RpcAcsRequest
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
        parent::__construct('retailcloud', '2018-03-13', 'DescribeSlbAPDetail', 'retailcloud');
    }

    /**
     * @param string $slbAPId
     *
     * @return $this
     */
    public function setSlbAPId($slbAPId)
    {
        $this->requestParameters['SlbAPId'] = $slbAPId;
        $this->queryParameters['SlbAPId'] = $slbAPId;

        return $this;
    }
}
