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
 * 新增文件到用户钉盘
 * @package DingDing\Corp\CSpace
 */
class UserSpaceAddFile extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 应用ID
     * @var string
     */
    private $agent_id = '';
    /**
     * 授权码
     * @var string
     */
    private $code = '';
    /**
     * 媒体ID
     * @var string
     */
    private $media_id = '';
    /**
     * 空间ID
     * @var string
     */
    private $space_id = '';
    /**
     * 文件夹ID
     * @var string
     */
    private $folder_id = '';
    /**
     * 文件名,包含扩展名
     * @var string
     */
    private $name = '';
    /**
     * 同名文件覆盖标识
     * @var bool
     */
    private $overwrite = false;

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $agentInfo = DingTalkConfigSingleton::getInstance()->getCorpConfig($corpId)->getAgentInfo($agentTag);
        $this->reqData['agent_id'] = $agentInfo['id'];
        $this->reqData['overwrite'] = false;
    }

    private function __clone()
    {
    }

    /**
     * @param string $code
     * @throws \SyException\DingDing\TalkException
     */
    public function setCode(string $code)
    {
        if (ctype_alnum($code)) {
            $this->reqData['code'] = $code;
        } else {
            throw new TalkException('授权码不合法', ErrorCode::DING_TALK_PARAM_ERROR);
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
     * @param string $spaceId
     * @throws \SyException\DingDing\TalkException
     */
    public function setSpaceId(string $spaceId)
    {
        if (ctype_alnum($spaceId)) {
            $this->reqData['space_id'] = $spaceId;
        } else {
            throw new TalkException('空间ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $folderId
     * @throws \SyException\DingDing\TalkException
     */
    public function setFolderId(string $folderId)
    {
        if (strlen($folderId) > 0) {
            $this->reqData['folder_id'] = $folderId;
        } else {
            throw new TalkException('文件夹ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $name
     * @throws \SyException\DingDing\TalkException
     */
    public function setName(string $name)
    {
        if (strlen($name) > 0) {
            $this->reqData['name'] = $name;
        } else {
            throw new TalkException('文件名不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param bool $overwrite
     */
    public function setOverwrite(bool $overwrite)
    {
        $this->reqData['overwrite'] = $overwrite;
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['code'])) {
            throw new TalkException('授权码不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['media_id'])) {
            throw new TalkException('媒体ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['space_id'])) {
            throw new TalkException('空间ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['folder_id'])) {
            throw new TalkException('文件夹ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['name'])) {
            throw new TalkException('文件名不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->reqData['access_token'] = $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/cspace/add?' . http_build_query($this->reqData);
        return $this->sendRequest('GET');
    }
}
