<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\LifeService;

use SyConstant\ErrorCode;
use SyDouYin\BaseLifeService;
use SyDouYin\TraitOpenId;
use SyException\DouYin\DouYinLifeServiceException;

/**
 * xxx
 *
 * @package SyDouYin\LifeService
 */
class MyDemo extends BaseLifeService
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
            throw new DouYinLifeServiceException('用户openid不能为空', ErrorCode::DOUYIN_LIFE_SERVICE_PARAM_ERROR);
        }

        $this->getContent();

        return $this->curlConfigs;
    }
}
