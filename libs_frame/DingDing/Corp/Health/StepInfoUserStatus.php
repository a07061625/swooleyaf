<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-31
 * Time: 下午4:20
 */
namespace DingDing\Corp\Health;

use SyConstant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 获取用户钉钉运动开启状态
 * @package DingDing\Corp\Health
 */
class StepInfoUserStatus extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 用户ID
     * @var string
     */
    private $userid = '';

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
    }

    private function __clone()
    {
    }

    /**
     * @param string $userId
     * @throws \SyException\DingDing\TalkException
     */
    public function setUserId(string $userId)
    {
        if (ctype_alnum($userId)) {
            $this->reqData['userid'] = $userId;
        } else {
            throw new TalkException('用户ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['userid'])) {
            throw new TalkException('用户ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/topapi/health/stepinfo/getuserstatus?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
