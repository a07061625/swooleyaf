<?php
/**
 * 查询直播间详情
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Provider;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetAdZoneIdTrait;
use SyPromotion\TBK\Traits\SetSiteIdTrait;

/**
 * Class LiveInfoGet
 *
 * @package SyPromotion\TBK\Provider
 */
class LiveInfoGet extends BaseTBK
{
    use SetSiteIdTrait;
    use SetAdZoneIdTrait;

    /**
     * 直播间ID列表
     *
     * @var array
     */
    private $live_ids = [];
    /**
     * 网站ID
     *
     * @var int
     */
    private $site_id = 0;
    /**
     * 广告位ID
     *
     * @var int
     */
    private $adzone_id = 0;
    /**
     * 渠道关系ID
     *
     * @var int
     */
    private $relation_id = 0;
    /**
     * 主播昵称列表
     *
     * @var array
     */
    private $nicknames = [];
    /**
     * 直播间类型
     *
     * @var int
     */
    private $live_query_type = 0;
    /**
     * 每页记录数
     *
     * @var int
     */
    private $page_size = 0;
    /**
     * 页码
     *
     * @var int
     */
    private $page_num = 0;
    /**
     * 直播间状态列表
     *
     * @var array
     */
    private $room_status = [];

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.sc.live.info.get');
        $this->reqData['page_num'] = 0;
        $this->reqData['page_size'] = 20;
        $this->reqData['live_query_type'] = 1;
        $this->reqData['room_status'] = '0,1';
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setLiveIds(array $liveIds)
    {
        $liveIdList = [];
        foreach ($liveIds as $eLiveId) {
            if (\is_int($eLiveId) && ($eLiveId > 0)) {
                $liveIdList[$eLiveId] = 1;
            }
        }
        $needNum = \count($liveIdList);
        if (0 == $needNum) {
            throw new TBKException('直播间ID列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if ($needNum > 10) {
            throw new TBKException('直播间ID列表不能超过10个', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $this->reqData['live_ids'] = implode(',', array_keys($liveIdList));
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setRelationId(int $relationId)
    {
        if ($relationId > 0) {
            $this->reqData['relation_id'] = $relationId;
        } else {
            throw new TBKException('渠道关系ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setNicknames(array $nicknames)
    {
        $nicknameList = [];
        foreach ($nicknames as $eNickname) {
            if (\is_int($eNickname) && (\strlen($eNickname) > 0)) {
                $nicknameList[$eNickname] = 1;
            }
        }
        $needNum = \count($nicknameList);
        if (0 == $needNum) {
            throw new TBKException('主播昵称列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if ($needNum > 5) {
            throw new TBKException('主播昵称列表不能超过5个', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $this->reqData['nicknames'] = implode(',', array_keys($nicknameList));
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setLiveQueryType(int $liveQueryType)
    {
        if (\in_array($liveQueryType, [1, 2])) {
            $this->reqData['live_query_type'] = $liveQueryType;
        } else {
            throw new TBKException('直播间类型不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setPageSize(int $pageSize)
    {
        if (($pageSize >= 1) && ($pageSize <= 50)) {
            $this->reqData['page_size'] = $pageSize;
        } else {
            throw new TBKException('每页记录数不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setPageNum(int $pageNum)
    {
        if ($pageNum >= 0) {
            $this->reqData['page_num'] = $pageNum;
        } else {
            throw new TBKException('页码不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setRoomStatus(array $roomStatus)
    {
        $roomStatusList = [];
        foreach ($roomStatus as $eStatus) {
            if (\is_int($eStatus) && \in_array($eStatus, [0, 1, 2])) {
                $roomStatusList[$eStatus] = 1;
            }
        }
        if (empty($roomStatusList)) {
            throw new TBKException('直播间状态列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $this->reqData['room_status'] = implode(',', array_keys($roomStatusList));
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['site_id'])) {
            throw new TBKException('网站ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['adzone_id'])) {
            throw new TBKException('广告位ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
