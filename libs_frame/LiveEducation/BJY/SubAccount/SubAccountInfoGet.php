<?php
/**
 * 获取子账号信息
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 13:42
 */
namespace LiveEducation\BJY\SubAccount;

use LiveEducation\BaseBJY;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class SubAccountInfoGet
 * @package LiveEducation\BJY\SubAccount
 */
class SubAccountInfoGet extends BaseBJY
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
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setSubPartnerId(int $subPartnerId)
    {
        if ($subPartnerId > 0) {
            $this->reqData['sub_partner_id'] = $subPartnerId;
        } else {
            throw new BJYException('子账号ID不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['sub_partner_id'])) {
            throw new BJYException('子账号ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
