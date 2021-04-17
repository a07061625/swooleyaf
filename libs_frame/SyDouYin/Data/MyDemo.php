<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\Data;

use SyConstant\ErrorCode;
use SyDouYin\BaseData;
use SyDouYin\TraitOpenId;
use SyException\DouYin\DouYinDataException;

/**
 * xxx
 *
 * @package SyDouYin\Data
 */
class MyDemo extends BaseData
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
            throw new DouYinDataException('用户openid不能为空', ErrorCode::DOUYIN_DATA_PARAM_ERROR);
        }

        $this->getContent();

        return $this->curlConfigs;
    }
}
