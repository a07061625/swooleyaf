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
        $host = Util::getServiceHost($type);
        if (\strlen($host) > 0) {
            $this->serviceHost = $host;
        } else {
            throw new DouYinException('服务域名不支持', ErrorCode::DOUYIN_PARAM_ERROR);
        }
    }
}
