<?php
/**
 * 备案接入方用户信息获取
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;

/**
 * Class UnionRecordUserInfoGet
 *
 * @package SyPromotion\TBK\Promoter
 */
class UnionRecordUserInfoGet extends BaseTBK
{
    /**
     * 备案纬度id
     *
     * @var string
     */
    private $Id = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('qimen.taobao.union.record.userinfo.get');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setId(string $Id)
    {
        if (\strlen($Id) > 0) {
            $this->reqData['Id'] = $Id;
        } else {
            throw new TBKException('备案纬度id不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['Id'])) {
            throw new TBKException('备案纬度id不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
