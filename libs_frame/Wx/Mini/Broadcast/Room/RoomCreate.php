<?php
/**
 * 创建直播间
 * User: 姜伟
 * Date: 2020/6/8 0008
 * Time: 21:47
 */

namespace Wx\Mini\Broadcast\Room;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMini;
use Wx\WxUtilAlone;
use Wx\WxUtilBase;

/**
 * Class RoomCreate
 *
 * @package Wx\Mini\Broadcast\Room
 */
class RoomCreate extends WxBaseMini
{
    /**
     * 应用ID
     *
     * @var string
     */
    private $appId = '';
    /**
     * 直播间名字
     *
     * @var string
     */
    private $name = '';
    /**
     * 直播间背景图
     *
     * @var string
     */
    private $coverImg = '';
    /**
     * 直播计划开始时间
     *
     * @var int
     */
    private $startTime = 0;
    /**
     * 直播计划结束时间
     *
     * @var int
     */
    private $endTime = 0;
    /**
     * 主播昵称
     *
     * @var string
     */
    private $anchorName = '';
    /**
     * 主播微信号
     *
     * @var string
     */
    private $anchorWechat = '';
    /**
     * 直播间分享图
     *
     * @var string
     */
    private $shareImg = '';
    /**
     * 直播类型 0:手机直播 1:推流
     *
     * @var int
     */
    private $type = 0;
    /**
     * 屏幕类型 0:竖屏 1:横屏
     *
     * @var int
     */
    private $screenType = 0;
    /**
     * 点赞关闭标识,关闭后无法开启 0:开启点赞 1:关闭点赞
     *
     * @var int
     */
    private $closeLike = 0;
    /**
     * 货架关闭标识,关闭后无法开启 0:打开货架 1:关闭货架
     *
     * @var int
     */
    private $closeGoods = 0;
    /**
     * 评论关闭标识,关闭后无法开启 0:打开评论 1:关闭评论
     *
     * @var int
     */
    private $closeComment = 0;

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxaapi/broadcast/room/create?access_token=';
        $this->appId = $appId;
        $this->reqData = [
            'type' => 1,
            'screenType' => 0,
            'closeLike' => 0,
            'closeGoods' => 0,
            'closeComment' => 0,
        ];
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setName(string $name)
    {
        $nameLength = \strlen($name);
        if (($nameLength > 0) && ($nameLength <= 34)) {
            $this->reqData['name'] = $name;
        } else {
            throw new WxException('直播间名字不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setCoverImg(string $coverImg)
    {
        if (\strlen($coverImg) > 0) {
            $this->reqData['coverImg'] = $coverImg;
        } else {
            throw new WxException('直播间背景图不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setTime(int $startTime, int $endTime)
    {
        $startDiffTime = $startTime - Tool::getNowTime();
        if ($startDiffTime <= 0) {
            throw new WxException('直播开始时间必须大于当前时间', ErrorCode::WX_PARAM_ERROR);
        }
        if ($startDiffTime <= 600) {
            throw new WxException('直播开始时间必须超过当前时间十分钟', ErrorCode::WX_PARAM_ERROR);
        }
        if ($startDiffTime >= 15552000) {
            throw new WxException('直播开始时间不能超过当前时间六个月', ErrorCode::WX_PARAM_ERROR);
        }

        $endDiffTime = $endTime - $startTime;
        if ($endDiffTime <= 0) {
            throw new WxException('直播结束时间必须大于直播开始时间', ErrorCode::WX_PARAM_ERROR);
        }
        if ($endDiffTime < 1800) {
            throw new WxException('直播结束时间必须大于等于直播开始时间30分钟', ErrorCode::WX_PARAM_ERROR);
        }
        if ($endDiffTime > 43200) {
            throw new WxException('直播结束时间不能超过直播开始时间12小时', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['startTime'] = $startTime;
        $this->reqData['endTime'] = $endTime;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setAnchorName(string $anchorName)
    {
        $nameLength = \strlen($anchorName);
        if (($nameLength > 0) && ($nameLength <= 30)) {
            $this->reqData['anchorName'] = $anchorName;
        } else {
            throw new WxException('主播昵称不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setAnchorWeChat(string $anchorWeChat)
    {
        if (\strlen($anchorWeChat) > 0) {
            $this->reqData['anchorWechat'] = $anchorWeChat;
        } else {
            throw new WxException('主播微信号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setShareImg(string $shareImg)
    {
        if (\strlen($shareImg) > 0) {
            $this->reqData['shareImg'] = $shareImg;
        } else {
            throw new WxException('直播间分享图不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setType(int $type)
    {
        if (\in_array($type, [0, 1], true)) {
            $this->reqData['type'] = $type;
        } else {
            throw new WxException('直播类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setScreenType(int $screenType)
    {
        if (\in_array($screenType, [0, 1], true)) {
            $this->reqData['screenType'] = $screenType;
        } else {
            throw new WxException('屏幕类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setCloseLike(int $closeLike)
    {
        if (\in_array($closeLike, [0, 1], true)) {
            $this->reqData['closeLike'] = $closeLike;
        } else {
            throw new WxException('点赞关闭标识不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setCloseGoods(int $closeGoods)
    {
        if (\in_array($closeGoods, [0, 1], true)) {
            $this->reqData['closeGoods'] = $closeGoods;
        } else {
            throw new WxException('货架关闭标识不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setCloseComment(int $closeComment)
    {
        if (\in_array($closeComment, [0, 1], true)) {
            $this->reqData['closeComment'] = $closeComment;
        } else {
            throw new WxException('评论关闭标识不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['name'])) {
            throw new WxException('直播间名字不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['coverImg'])) {
            throw new WxException('直播间背景图不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['startTime'])) {
            throw new WxException('直播开始时间不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['anchorName'])) {
            throw new WxException('主播昵称不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['anchorWechat'])) {
            throw new WxException('主播微信号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['shareImg'])) {
            throw new WxException('直播间分享图不能为空', ErrorCode::WX_PARAM_ERROR);
        }

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
