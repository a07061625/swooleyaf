<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:11
 */

namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Pay\UnionException;

/**
 * Class FrontUrlTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait FrontUrlTrait
{
    /**
     * @throws \SyException\Pay\UnionException
     */
    public function setFrontUrl(string $frontUrl)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $frontUrl) > 0) {
            $this->reqData['frontUrl'] = $frontUrl;
        } else {
            throw new UnionException('前台通知地址不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
