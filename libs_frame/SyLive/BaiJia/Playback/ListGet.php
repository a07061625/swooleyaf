<?php
/**
 * 获取回放列表
 * User: 姜伟
 * Date: 2020/4/1 0001
 * Time: 10:16
 */
namespace SyLive\BaiJia\Playback;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class ListGet
 * @package SyLive\BaiJia\Playback
 */
class ListGet extends BaseBaiJia
{
    /**
     * 产品类型 1:大班课 2:小班课 3:双师 4:企业直播
     * @var int
     */
    private $product_type = 0;
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
     * 是否返回裁剪视频的回放 0:否 1:是
     * @var int
     */
    private $crop_video = 0;
    /**
     * 房间ID
     * @var int
     */
    private $room_id = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/playback/getList';
        $this->reqData['page'] = 1;
        $this->reqData['page_size'] = 20;
    }

    private function __clone()
    {
    }

    /**
     * @param int $productType
     * @throws \SyException\Live\BaiJiaException
     */
    public function setProductType(int $productType)
    {
        if (in_array($productType, [1, 2, 3, 4])) {
            $this->reqData['product_type'] = $productType;
        } else {
            throw new BaiJiaException('产品类型不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
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
     * @param int $cropVideo
     * @throws \SyException\Live\BaiJiaException
     */
    public function setCropVideo(int $cropVideo)
    {
        if (in_array($cropVideo, [0, 1])) {
            $this->reqData['crop_video'] = $cropVideo;
        } else {
            throw new BaiJiaException('视频回放标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $roomId
     * @throws \SyException\Live\BaiJiaException
     */
    public function setRoomId(int $roomId)
    {
        if ($roomId > 0) {
            $this->reqData['room_id'] = $roomId;
        } else {
            throw new BaiJiaException('房间ID不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['product_type'])) {
            throw new BaiJiaException('产品类型不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
