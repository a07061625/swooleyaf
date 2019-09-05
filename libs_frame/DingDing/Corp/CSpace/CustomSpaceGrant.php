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
 * 授权用户访问企业自定义空间
 * @package DingDing\Corp\CSpace
 */
class CustomSpaceGrant extends TalkBaseCorp
{
    use TalkTraitCorp;

    const TYPE_ADD = 'add'; //权限类型-上传
    const TYPE_DOWNLOAD = 'download'; //权限类型-下载

    /**
     * 应用ID
     * @var string
     */
    private $agent_id = '';
    /**
     * 域名
     * @var string
     */
    private $domain = '';
    /**
     * 权限类型
     * @var string
     */
    private $type = '';
    /**
     * 用户ID
     * @var string
     */
    private $userid = '';
    /**
     * 授权路径
     * @var string
     */
    private $path = '';
    /**
     * 文件列表
     * @var string
     */
    private $fileids = '';
    /**
     * 权限有效时间
     * @var int
     */
    private $duration = 0;

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['duration'] = 30;
    }

    private function __clone()
    {
    }

    public function setAgentId()
    {
        $agentInfo = DingTalkConfigSingleton::getInstance()->getCorpConfig($this->_corpId)->getAgentInfo($this->_agentTag);
        $this->reqData['agent_id'] = $agentInfo['id'];
        unset($this->reqData['domain']);
    }

    /**
     * @param string $domain
     * @throws \SyException\DingDing\TalkException
     */
    public function setDomain(string $domain)
    {
        if (ctype_alnum($domain) && (strlen($domain) <= 10)) {
            $this->reqData['domain'] = $domain;
            unset($this->reqData['agent_id']);
        } else {
            throw new TalkException('域名不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $type
     * @throws \SyException\DingDing\TalkException
     */
    public function setType(string $type)
    {
        if (in_array($type, [self::TYPE_ADD, self::TYPE_DOWNLOAD], true)) {
            $this->reqData['type'] = $type;
        } else {
            throw new TalkException('权限类型不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
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
     * @param string $path
     * @throws \SyException\DingDing\TalkException
     */
    public function setPath(string $path)
    {
        if (strlen($path) > 0) {
            $this->reqData['path'] = $path;
        } else {
            throw new TalkException('授权路径不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param array $fileIds
     * @throws \SyException\DingDing\TalkException
     */
    public function setFileIds(array $fileIds)
    {
        $files = [];
        foreach ($fileIds as $eFileId) {
            if (is_string($eFileId) && (strlen($eFileId) > 0)) {
                $files[$eFileId] = 1;
            }
        }
        if (count($files) == 0) {
            throw new TalkException('文件列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['fileids'] = implode(',', array_keys($files));
    }

    /**
     * @param int $duration
     * @throws \SyException\DingDing\TalkException
     */
    public function setDuration(int $duration)
    {
        if (($duration > 0) && ($duration <= 3600)) {
            $this->reqData['duration'] = $duration;
        } else {
            throw new TalkException('权限有效时间不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (isset($this->reqData['agent_id'])) {
            $this->reqData['access_token'] = $this->getAccessToken(TalkBaseCorp::ACCESS_TOKEN_TYPE_PROVIDER, $this->_corpId, $this->_agentTag);
        } elseif (isset($this->reqData['domain'])) {
            $this->reqData['access_token'] = $this->getAccessToken(TalkBaseCorp::ACCESS_TOKEN_TYPE_CORP, $this->_corpId, $this->_agentTag);
        } else {
            throw new TalkException('域名和应用ID不能同时为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['type'])) {
            throw new TalkException('权限类型不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['userid'])) {
            throw new TalkException('用户ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (($this->reqData['type'] == self::TYPE_ADD) && !isset($this->reqData['path'])) {
            throw new TalkException('授权路径不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        } elseif (($this->reqData['type'] == self::TYPE_DOWNLOAD) && !isset($this->reqData['fileids'])) {
            throw new TalkException('文件列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/cspace/grant_custom_space?' . http_build_query($this->reqData);
        return $this->sendRequest('GET');
    }
}
