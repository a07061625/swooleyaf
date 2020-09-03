<?php
/**
 * 获取子账号信息
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 13:42
 */
namespace SyLive\BaiJia\SubAccount;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class SubAccountInfoGet
 * @package SyLive\BaiJia\SubAccount
 */
class SubAccountInfoGet extends BaseBaiJia
{
    /**
     * 子账号ID
     * @var int
     */
    private $sub_partner_id = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/sub_account/getSubAccountInfo';
    }

    private function __clone()
    {
    }

    /**
     * @param int $subPartnerId
     * @throws \SyException\Live\BaiJiaException
     */
    public function setSubPartnerId(int $subPartnerId)
    {
        if ($subPartnerId > 0) {
            $this->reqData['sub_partner_id'] = $subPartnerId;
        } else {
            throw new BaiJiaException('子账号ID不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['sub_partner_id'])) {
            throw new BaiJiaException('子账号ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
