<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\Search;

use SyConstant\ErrorCode;
use SyDouYin\BaseSearch;
use SyDouYin\TraitOpenId;
use SyException\DouYin\DouYinSearchException;

/**
 * xxx
 *
 * @package SyDouYin\Search
 */
class MyDemo extends BaseSearch
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
            throw new DouYinSearchException('用户openid不能为空', ErrorCode::DOUYIN_SEARCH_PARAM_ERROR);
        }

        $this->getContent();

        return $this->curlConfigs;
    }
}
