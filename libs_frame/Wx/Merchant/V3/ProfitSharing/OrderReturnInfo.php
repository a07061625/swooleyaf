<?php
/**
 * 查询分账回退结果
 * User: 姜伟
 * Date: 2022/12/21
 * Time: 15:30
 */

namespace Wx\Merchant\V3\ProfitSharing;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use Wx\WxBaseMerchantV3;
use Wx\WxUtilBase;

/**
 * Class OrderReturnInfo
 *
 * @package Wx\Merchant\V3\ProfitSharing
 */
class OrderReturnInfo extends WxBaseMerchantV3
{
    /**
     * 商户回退单号
     *
     * @var string
     */
    private $out_return_no = '';
    /**
     * 商户分账单号
     *
     * @var string
     */
    private $out_order_no = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->reqMethod = self::REQUEST_METHOD_GET;
        $this->setHeadJson();
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setOutReturnNo(string $outReturnNo)
    {
        if (ctype_alnum($outReturnNo) && (\strlen($outReturnNo) <= 64)) {
            $this->out_return_no = $outReturnNo;
        } else {
            throw new WxException('商户回退单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setOutOrderNo(string $outOrderNo)
    {
        if (ctype_alnum($outOrderNo) && (\strlen($outOrderNo) <= 64)) {
            $this->reqData['out_order_no'] = $outOrderNo;
        } else {
            throw new WxException('商户分账单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Common\CheckException
     * @throws \SyException\Wx\WxException
     */
    public function getDetail(): array
    {
        if (0 == \strlen($this->out_return_no)) {
            throw new WxException('商户回退单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['out_order_no'])) {
            throw new WxException('商户分账单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = 'https://api.mch.weixin.qq.com/v3/profitsharing/return-orders/'
                                          . $this->out_return_no
                                          . '?' . http_build_query($this->reqData);
        $this->setHeadAuth();
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs, 2);

        return $this->handleRespJson($sendRes);
    }
}
