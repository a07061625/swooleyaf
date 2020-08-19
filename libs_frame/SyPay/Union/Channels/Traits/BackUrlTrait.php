<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:03
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Trait BackUrlTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait BackUrlTrait
{
    /**
     * @param string $backUrl
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setBackUrl(string $backUrl)
    {
        $trueUrl = trim($backUrl);
        if (strlen($trueUrl) > 0) {
            $this->reqData['backUrl'] = $trueUrl;
        } else {
            throw new UnionException('后台通知地址不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
