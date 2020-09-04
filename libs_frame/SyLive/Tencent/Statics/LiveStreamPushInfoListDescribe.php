<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 15:36
 */
namespace SyLive\Tencent\Statics;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 获取在线流的推流数据
 *
 * @package SyLive\Tencent\Statics
 */
class LiveStreamPushInfoListDescribe extends BaseTencent
{
    /**
     * 推流域名
     *
     * @var string
     */
    private $PushDomain = '';
    /**
     * 推流路径
     *
     * @var string
     */
    private $AppName = '';
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
        $this->reqHeader['X-TC-Action'] = 'DescribeLiveStreamPushInfoList';
        $this->reqData['PageNum'] = 1;
        $this->reqData['PageSize'] = 200;
        $this->reqData['AppName'] = 'live';
    }

    private function __clone()
    {
    }

    /**
     * @param string $pushDomain
     */
    public function setPushDomain(string $pushDomain)
    {
        if (strlen($pushDomain) > 0) {
            $this->reqData['PushDomain'] = $pushDomain;
        }
    }

    /**
     * @param string $appName
     */
    public function setAppName(string $appName)
    {
        if (strlen($appName) > 0) {
            $this->reqData['AppName'] = $appName;
        }
    }

    /**
     * @param int $pageNum
     *
     * @throws \SyException\Live\TencentException
     */
    public function setPageNum(int $pageNum)
    {
        if (($pageNum > 0) && ($pageNum <= 10000)) {
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
        if (($pageSize >= 1) && ($pageSize <= 1000)) {
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
