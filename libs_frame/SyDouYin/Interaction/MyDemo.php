<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\Interaction;

use SyConstant\ErrorCode;
use SyDouYin\BaseInteraction;
use SyDouYin\TraitOpenId;
use SyException\DouYin\DouYinInteractionException;

/**
 * xxx
 *
 * @package SyDouYin\Interaction
 */
class MyDemo extends BaseInteraction
{
    use TraitOpenId;

    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/xxx';
    }

    private function __clone()
    {
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['open_id'])) {
            throw new DouYinInteractionException('用户openid不能为空', ErrorCode::DOUYIN_INTERACTION_PARAM_ERROR);
        }

        $this->getContent();

        return $this->curlConfigs;
    }
}
