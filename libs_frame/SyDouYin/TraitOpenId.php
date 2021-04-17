<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/17 0017
 * Time: 9:35
 */

namespace SyDouYin;

use SyConstant\ErrorCode;
use SyException\DouYin\DouYinException;

/**
 * Trait TraitOpenId
 *
 * @package SyDouYin
 */
trait TraitOpenId
{
    /**
     * @param string $openId 用户openid
     *
     * @throws \SyException\DouYin\DouYinException
     */
    public function setOpenId(string $openId)
    {
        if (\strlen($openId) > 0) {
            $this->reqData['open_id'] = $openId;
        } else {
            throw new DouYinException('用户openid不合法', ErrorCode::DOUYIN_PARAM_ERROR);
        }
    }
}
