<?php
namespace Wx\Corp\OA;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseCorp;
use Wx\WxTraitCorp;
use Wx\WxUtilBase;

/**
 * 获取打卡数据
 * @package Wx\Corp\OA
 */
class CheckInDataGet extends WxBaseCorp
{
    use WxTraitCorp;

    /**
     * 打卡类型
     * @var int
     */
    private $opencheckindatatype = 0;
    /**
     * 开始时间
     * @var int
     */
    private $starttime = 0;
    /**
     * 结束时间
     * @var int
     */
    private $endtime = 0;
    /**
     * 用户列表
     * @var array
     */
    private $useridlist = [];

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/checkin/getcheckindata?access_token=';
        $this->reqData['useridlist'] = [];
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
    }

    private function __clone()
    {
    }

    /**
     * @param int $checkInType
     * @throws \SyException\Wx\WxException
     */
    public function setCheckInType(int $checkInType)
    {
        if (in_array($checkInType, [1, 2, 3], true)) {
            $this->reqData['opencheckindatatype'] = $checkInType;
        } else {
            throw new WxException('打卡类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param int $startTime
     * @param int $endTime
     * @throws \SyException\Wx\WxException
     */
    public function setStartTimeAndEndTime(int $startTime, int $endTime)
    {
        if ($startTime <= 1000000000) {
            throw new WxException('开始时间不合法', ErrorCode::WX_PARAM_ERROR);
        } elseif ($endTime <= 1000000000) {
            throw new WxException('结束时间不合法', ErrorCode::WX_PARAM_ERROR);
        } elseif ($startTime > $endTime) {
            throw new WxException('开始时间不能大于结束时间', ErrorCode::WX_PARAM_ERROR);
        } elseif (($endTime - $startTime) > 2592000) {
            throw new WxException('结束时间不能超过开始时间30天', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['starttime'] = $startTime;
        $this->reqData['endtime'] = $endTime;
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
        if (!isset($this->reqData['opencheckindatatype'])) {
            throw new WxException('打卡类型不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['starttime'])) {
            throw new WxException('开始时间不能为空', ErrorCode::WX_PARAM_ERROR);
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
