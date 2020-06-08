<?php
/**
 * 获取回放源视频列表
 * User: 姜伟
 * Date: 2020/6/8 0008
 * Time: 21:40
 */
namespace Wx\Mini\Broadcast\Live;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMini;
use Wx\WxUtilAlone;
use Wx\WxUtilBase;

/**
 * Class ReplayList
 * @package Wx\Mini\Broadcast\Live
 */
class ReplayList extends WxBaseMini
{
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 直播间ID
     * @var int
     */
    private $room_id = 0;
    /**
     * 起始索引
     * @var int
     */
    private $start = 0;
    /**
     * 每页数量
     * @var int
     */
    private $limit = 0;

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'http://api.weixin.qq.com/wxa/business/getliveinfo?access_token=';
        $this->appId = $appId;
        $this->reqData = [
            'action' => 'get_replay',
            'start' => 0,
            'limit' => 10,
        ];
    }

    private function __clone()
    {
    }

    /**
     * @param int $roomId
     * @throws \SyException\Wx\WxException
     */
    public function setRoomId(int $roomId)
    {
        if ($roomId >= 0) {
            $this->reqData['room_id'] = $roomId;
        } else {
            throw new WxException('直播间ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param int $start
     * @throws \SyException\Wx\WxException
     */
    public function setStart(int $start)
    {
        if ($start >= 0) {
            $this->reqData['start'] = $start;
        } else {
            throw new WxException('起始索引不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param int $limit
     * @throws \SyException\Wx\WxException
     */
    public function setLimit(int $limit)
    {
        if (($limit > 0) && ($limit <= 100)) {
            $this->reqData['limit'] = $limit;
        } else {
            throw new WxException('每页数量不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new WxException('直播间ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAlone::getAccessToken($this->appId);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
