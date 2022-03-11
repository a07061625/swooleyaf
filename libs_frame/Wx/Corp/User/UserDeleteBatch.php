<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/22 0022
 * Time: 11:05
 */

namespace Wx\Corp\User;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseCorp;
use Wx\WxTraitCorp;
use Wx\WxUtilBase;

/**
 * 批量删除成员
 *
 * @package Wx\Corp\User
 */
class UserDeleteBatch extends WxBaseCorp
{
    use WxTraitCorp;

    /**
     * 用户ID列表
     *
     * @var array
     */
    private $useridlist = [];

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/user/batchdelete?access_token=';
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['useridlist'] = [];
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setUserIdList(array $userIdList)
    {
        $users = [];
        foreach ($userIdList as $eUserId) {
            if (ctype_alnum($eUserId)) {
                $userId = strtolower($eUserId);
                $users[$userId] = 1;
            }
        }

        $userNum = \count($users);
        if ($userNum > 200) {
            throw new WxException('用户ID列表不能超过200个', ErrorCode::WX_PARAM_ERROR);
        }
        if (0 == $userNum) {
            throw new WxException('用户ID列表不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['useridlist'] = array_keys($users);
    }

    public function getDetail(): array
    {
        if (empty($this->reqData['useridlist'])) {
            throw new WxException('用户ID列表不能为空', ErrorCode::WX_PARAM_ERROR);
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
