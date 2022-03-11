<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/22 0022
 * Time: 11:05
 */

namespace Wx\Corp\Batch;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseCorp;
use Wx\WxTraitCorp;
use Wx\WxUtilBase;

/**
 * 增量更新成员
 *
 * @package Wx\Corp\Batch
 */
class UserSync extends WxBaseCorp
{
    use WxTraitCorp;

    /**
     * 媒体ID
     *
     * @var string
     */
    private $media_id = '';
    /**
     * 邀请标识,默认值为true true:邀请使用企业微信 false:不邀请
     *
     * @var bool
     */
    private $to_invite = true;
    /**
     * 回调信息
     *
     * @var array
     */
    private $callback = [];

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/batch/syncuser?access_token=';
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['to_invite'] = true;
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setMediaId(string $mediaId)
    {
        if (\strlen($mediaId) > 0) {
            $this->reqData['media_id'] = $mediaId;
        } else {
            throw new WxException('媒体ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function setInviteFlag(bool $inviteFlag)
    {
        $this->reqData['to_invite'] = $inviteFlag;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setCallback(array $callback)
    {
        if (empty($callback)) {
            throw new WxException('回调信息不合法', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['callback'] = $callback;
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['media_id'])) {
            throw new WxException('媒体ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
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
