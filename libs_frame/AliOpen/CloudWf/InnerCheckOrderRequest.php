<?php
namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 * 
 *
 * Request of InnerCheckOrder
 *
 * @method string getdata()
 */
class InnerCheckOrderRequest extends RpcAcsRequest
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
            'InnerCheckOrder',
            'cloudwf'
        );
    }

    /**
     * @param string $data
     *
     * @return $this
     */
    public function setdata($data)
    {
        $this->requestParameters['data'] = $data;
        $this->queryParameters['data'] = $data;

        return $this;
    }
}
