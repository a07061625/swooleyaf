<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-9
 * Time: 下午5:13
 */
namespace DingDing\Corp\CSpace;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\DingTalkConfigSingleton;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;

/**
 * 发送钉盘文件给指定用户
 * @package DingDing\Corp\CSpace
 */
class UserAddFile extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 应用ID
     * @var string
     */
    private $agent_id = '';
    /**
     * 用户ID
     * @var string
     */
    private $userid = '';
    /**
     * 媒体ID
     * @var string
     */
    private $media_id = '';
    /**
     * 文件名,包含扩展名
     * @var string
     */
    private $file_name = '';

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $agentInfo = DingTalkConfigSingleton::getInstance()->getCorpConfig($corpId)->getAgentInfo($agentTag);
        $this->reqData['agent_id'] = $agentInfo['id'];
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

    /**
     * @param string $mediaId
     * @throws \SyException\DingDing\TalkException
     */
    public function setMediaId(string $mediaId)
    {
        if (strlen($mediaId) > 0) {
            $this->reqData['media_id'] = $mediaId;
        } else {
            throw new TalkException('媒体ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $fileName
     * @throws \SyException\DingDing\TalkException
     */
    public function setFileName(string $fileName)
    {
        if (strlen($fileName) > 0) {
            $this->reqData['file_name'] = $fileName;
        } else {
            throw new TalkException('文件名不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['userid'])) {
            throw new TalkException('用户ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['media_id'])) {
            throw new TalkException('媒体ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['file_name'])) {
            throw new TalkException('文件名不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->reqData['access_token'] = $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/cspace/add_to_single_chat?' . http_build_query($this->reqData);
        return $this->sendRequest('GET');
    }
}
