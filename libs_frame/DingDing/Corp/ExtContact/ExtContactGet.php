<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-7
 * Time: 下午4:23
 */
namespace DingDing\Corp\ExtContact;

use SyConstant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 获取企业外部联系人详情
 * @package DingDing\Corp\ExtContact
 */
class ExtContactGet extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 用户id
     * @var string
     */
    private $user_id = '';

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
            $this->reqData['user_id'] = $userId;
        } else {
            throw new TalkException('用户id不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['user_id'])) {
            throw new TalkException('用户id不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/topapi/extcontact/get?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
