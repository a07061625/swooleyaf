<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 15:49
 */

namespace SyDouYin;

use SyConstant\ErrorCode;
use SyException\DouYin\DouYinException;

/**
 * Trait ServiceHostTrait
 *
 * @package SyDouYin
 */
trait ServiceHostTrait
{
    public function setServiceHost(string $type)
    {
        if (isset(Util::$totalServiceHost[$type])) {
            $this->serviceHost = Util::$totalServiceHost[$type];
        } else {
            throw new DouYinException('服务域名不支持', ErrorCode::DOUYIN_PARAM_ERROR);
        }
    }
}
