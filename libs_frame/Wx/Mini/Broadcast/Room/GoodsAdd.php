<?php
/**
 * 往指定直播间导入已入库的商品
 * User: 姜伟
 * Date: 2020/6/21 0021
 * Time: 10:44
 */

namespace Wx\Mini\Broadcast\Room;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMini;
use Wx\WxUtilAlone;
use Wx\WxUtilBase;

/**
 * Class GoodsAdd
 *
 * @package Wx\Mini\Broadcast\Room
 */
class GoodsAdd extends WxBaseMini
{
    /**
     * 应用ID
     *
     * @var string
     */
    private $appId = '';
    /**
     * 房间ID
     *
     * @var int
     */
    private $roomId = 0;
    /**
     * 商品ID列表
     *
     * @var array
     */
    private $ids = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxaapi/broadcast/room/addgoods?access_token=';
        $this->appId = $appId;
        $this->reqData = [];
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setRoomId(int $roomId)
    {
        if ($roomId > 0) {
            $this->reqData['roomId'] = $roomId;
        } else {
            throw new WxException('房间ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function setIds(array $idList)
    {
        $this->ids = [];
        foreach ($idList as $eId) {
            if (\is_int($eId) && ($eId > 0)) {
                $this->ids[$eId] = 1;
            }
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function getDetail(): array
    {
        if (!isset($this->reqData['roomId'])) {
            throw new WxException('房间ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (empty($this->ids)) {
            throw new WxException('商品ID列表不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['ids'] = array_keys($this->ids);

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAlone::getAccessToken($this->appId);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (0 == $sendData['errcode']) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
