<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:26
 */

namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Pay\UnionException;

/**
 * Class FrontFailUrlTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait FrontFailUrlTrait
{
    /**
     * @throws \SyException\Pay\UnionException
     */
    public function setFrontFailUrl(string $frontFailUrl)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $frontFailUrl) > 0) {
            $this->reqData['frontFailUrl'] = $frontFailUrl;
        } else {
            throw new UnionException('失败交易前台跳转地址不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
