<?php
/**
 * 获取直播房间列表
 * User: 姜伟
 * Date: 2020/6/8 0008
 * Time: 21:25
 */
namespace Wx\Mini\Broadcast\Room;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMini;
use Wx\WxUtilAlone;
use Wx\WxUtilBase;

/**
 * Class RoomList
 * @package Wx\Mini\Broadcast\Room
 */
class RoomList extends WxBaseMini
{
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
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
            'start' => 0,
            'limit' => 10,
        ];
    }

    private function __clone()
    {
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
