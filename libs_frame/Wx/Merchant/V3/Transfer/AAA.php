<?php
/**
 * 通过微信批次单号查询批次单
 * User: 姜伟
 * Date: 2022/12/20
 * Time: 11:24
 */
namespace Wx\Merchant\V3\Transfer;

use Wx\WxBaseMerchantV3;

/**
 * Class AAA
 * @package Wx\Merchant\V3\Transfer
 */
class AAA extends WxBaseMerchantV3
{
    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setHeadJson();
    }

    private function __clone()
    {
        //do nothing
    }

    public function getDetail() : array
    {
        $sendRes = [
            'code' => 0,
        ];

        return $this->handleRespJson($sendRes);
    }
}
