<?php
/**
 * 获取点播视频列表
 * User: 姜伟
 * Date: 2020/4/1 0001
 * Time: 18:54
 */
namespace SyLive\BaiJia\VodVideo;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class VideoListGet
 * @package SyLive\BaiJia\VodVideo
 */
class VideoListGet extends BaseBaiJia
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
    /**
     * 创建时间
     * @var string
     */
    private $create_time = '';

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/video/getVideoList';
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

    /**
     * @param int $createTime
     * @throws \SyException\Live\BaiJiaException
     */
    public function setCreateTime(int $createTime)
    {
        if($createTime > 1262275200){
            $this->reqData['create_time'] = date('Y-m-d H:i:s', $createTime);
        } else {
            throw new BaiJiaException('创建时间不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
