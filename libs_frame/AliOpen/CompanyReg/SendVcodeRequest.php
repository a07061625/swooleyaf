<?php
namespace AliOpen\CompanyReg;

use AliOpen\Core\RpcAcsRequest;

/**
 * 
 *
 * Request of SendVcode
 *
 * @method string getMobile()
 * @method string getBizCode()
 */
class SendVcodeRequest extends RpcAcsRequest
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
            'companyreg',
            '2019-05-08',
            'SendVcode',
            'companyreg'
        );
    }

    /**
     * @param string $mobile
     *
     * @return $this
     */
    public function setMobile($mobile)
    {
        $this->requestParameters['Mobile'] = $mobile;
        $this->queryParameters['Mobile'] = $mobile;

        return $this;
    }

    /**
     * @param string $bizCode
     *
     * @return $this
     */
    public function setBizCode($bizCode)
    {
        $this->requestParameters['BizCode'] = $bizCode;
        $this->queryParameters['BizCode'] = $bizCode;

        return $this;
    }
}
