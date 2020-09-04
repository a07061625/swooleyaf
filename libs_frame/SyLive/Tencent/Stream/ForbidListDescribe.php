<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/4 0004
 * Time: 8:35
 */
namespace SyLive\Tencent\Stream;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 获取禁推流列表
 *
 * @package SyLive\Tencent\Stream
 */
class ForbidListDescribe extends BaseTencent
{
    /**
     * 页数,默认1
     *
     * @var int
     */
    private $PageNum = 0;
    /**
     * 每页个数,默认20
     *
     * @var int
     */
    private $PageSize = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeLiveForbidStreamList';
        $this->reqData['PageNum'] = 1;
        $this->reqData['PageSize'] = 10;
    }

    private function __clone()
    {
    }

    /**
     * @param int $pageNum
     *
     * @throws \SyException\Live\TencentException
     */
    public function setPageNum(int $pageNum)
    {
        if ($pageNum > 0) {
            $this->reqData['PageNum'] = $pageNum;
        } else {
            throw new TencentException('页数不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $pageSize
     *
     * @throws \SyException\Live\TencentException
     */
    public function setPageSize(int $pageSize)
    {
        if (($pageSize >= 1) && ($pageSize <= 100)) {
            $this->reqData['PageSize'] = $pageSize;
        } else {
            throw new TencentException('每页个数不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
