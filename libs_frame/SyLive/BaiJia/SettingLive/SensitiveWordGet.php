<?php
/**
 * 查看当前敏感词列表
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 8:53
 */
namespace SyLive\BaiJia\SettingLive;

use SyLive\BaseBaiJiaSetting;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class SensitiveWordGet
 * @package SyLive\BaiJia\SettingLive
 */
class SensitiveWordGet extends BaseBaiJiaSetting
{
    /**
     * 页数
     * @var int
     */
    private $page = 0;
    /**
     * 每页条数
     * @var int
     */
    private $page_size = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/live_setting/getSensitiveWord';
        $this->reqData['page'] = 1;
        $this->reqData['page_size'] = 20;
    }

    private function __clone()
    {
    }

    /**
     * @param int $page
     * @throws \SyException\Live\BaiJiaException
     */
    public function setPage(int $page)
    {
        if ($page > 0) {
            $this->reqData['page'] = $page;
        } else {
            throw new BaiJiaException('页数不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $pageSize
     * @throws \SyException\Live\BaiJiaException
     */
    public function setPageSize(int $pageSize)
    {
        if (($pageSize > 0) && ($pageSize <= 1000)) {
            $this->reqData['page_size'] = $pageSize;
        } else {
            throw new BaiJiaException('每页条数不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
