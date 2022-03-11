<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/22 0022
 * Time: 11:05
 */

namespace Wx\Corp\Crm;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseCorp;
use Wx\WxTraitCorp;
use Wx\WxUtilBase;

/**
 * 离职成员的外部联系人再分配
 *
 * @package Wx\Corp\Crm
 */
class ExternalContactTransfer extends WxBaseCorp
{
    use WxTraitCorp;

    /**
     * 外部联系人用户ID
     *
     * @var string
     */
    private $external_userid = '';
    /**
     * 离职成员用户ID
     *
     * @var string
     */
    private $handover_userid = '';
    /**
     * 接替成员用户ID
     *
     * @var string
     */
    private $takeover_userid = '';

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/crm/transfer_external_contact?access_token=';
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setExternalUserId(string $externalUserId)
    {
        if (ctype_alnum($externalUserId)) {
            $this->reqData['external_userid'] = $externalUserId;
        } else {
            throw new WxException('外部联系人用户ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setHandoverUserId(string $handoverUserId)
    {
        if (ctype_alnum($handoverUserId)) {
            $this->reqData['handover_userid'] = $handoverUserId;
        } else {
            throw new WxException('离职成员用户ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setTakeoverUserId(string $takeoverUserId)
    {
        if (ctype_alnum($takeoverUserId)) {
            $this->reqData['takeover_userid'] = $takeoverUserId;
        } else {
            throw new WxException('接替成员用户ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['external_userid'])) {
            throw new WxException('外部联系人用户ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['handover_userid'])) {
            throw new WxException('离职成员用户ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['takeover_userid'])) {
            throw new WxException('接替成员用户ID不能为空', ErrorCode::WX_PARAM_ERROR);
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
