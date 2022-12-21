<?php
/**
 * 分账账单列表
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
 * Class BillList
 *
 * @package Wx\Merchant\V3\ProfitSharing
 */
class BillList extends WxBaseMerchantV3
{
    /**
     * 账单日期,格式yyyy-MM-DD
     *
     * @var string
     */
    private $bill_date = '';

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
    public function setBillDate(string $billDate)
    {
        if (10 == \strlen($billDate)) {
            $this->reqData['bill_date'] = $billDate;
        } else {
            throw new WxException('账单日期不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Common\CheckException
     * @throws \SyException\Wx\WxException
     */
    public function getDetail(): array
    {
        if (!isset($this->reqData['bill_date'])) {
            throw new WxException('账单日期不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = 'https://api.mch.weixin.qq.com/v3/profitsharing/bills?'
                                         . http_build_query($this->reqData);
        $this->setHeadAuth();
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs, 2);

        return $this->handleRespJson($sendRes);
    }
}
