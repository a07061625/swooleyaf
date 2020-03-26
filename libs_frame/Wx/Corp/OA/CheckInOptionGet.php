<?php
namespace Wx\Corp\OA;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseCorp;
use Wx\WxTraitCorp;
use Wx\WxUtilBase;

/**
 * 获取打卡规则
 * @package Wx\Corp\OA
 */
class CheckInOptionGet extends WxBaseCorp
{
    use WxTraitCorp;

    /**
     * 日期
     * @var int
     */
    private $datetime = 0;
    /**
     * 用户列表
     * @var array
     */
    private $useridlist = [];

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/checkin/getcheckinoption?access_token=';
        $this->reqData['useridlist'] = [];
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
    }

    private function __clone()
    {
    }

    /**
     * @param int $datetime
     * @throws \SyException\Wx\WxException
     */
    public function setDatetime(int $datetime)
    {
        if (($datetime > 0) && (($datetime % 86400) == 0)) {
            $this->reqData['datetime'] = $datetime;
        } else {
            throw new WxException('日期不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param array $userIdList
     * @throws \SyException\Wx\WxException
     */
    public function setUserIdList(array $userIdList)
    {
        $idList = [];
        foreach ($userIdList as $eUserId) {
            if (ctype_alnum($eUserId)) {
                $idList[$eUserId] = 1;
            }
        }

        $userNum = count($idList);
        if ($userNum == 0) {
            throw new WxException('用户列表不能为空', ErrorCode::WX_PARAM_ERROR);
        } elseif ($userNum > 100) {
            throw new WxException('用户列表不能超过100个', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['useridlist'] = array_keys($idList);
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['datetime'])) {
            throw new WxException('日期不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (empty($this->reqData['useridlist'])) {
            throw new WxException('用户列表不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . $this->getAccessToken(WxBaseCorp::ACCESS_TOKEN_TYPE_CORP, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
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
