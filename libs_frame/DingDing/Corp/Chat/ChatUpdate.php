<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-3
 * Time: 下午1:45
 */
namespace DingDing\Corp\Chat;

use SyConstant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 修改会话
 * @package DingDing\Corp\Chat
 */
class ChatUpdate extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 会话ID
     * @var string
     */
    private $chatid = '';
    /**
     * 群名称
     * @var string
     */
    private $name = '';
    /**
     * 群主
     * @var string
     */
    private $owner = '';
    /**
     * 添加成员列表
     * @var array
     */
    private $add_useridlist = [];
    /**
     * 删除成员列表
     * @var array
     */
    private $del_useridlist = [];
    /**
     * 群头像
     * @var string
     */
    private $icon = '';
    /**
     * 群禁言标识 true:禁言 false:不禁言
     * @var bool
     */
    private $isBan = true;
    /**
     * 搜索类型 0:默认,不可搜索 1:可搜索
     * @var int
     */
    private $searchable = 0;
    /**
     * 验证类型 0:默认,不验证 1:验证
     * @var int
     */
    private $validationType = 0;
    /**
     * 通知所有人权限 0:默认,所有人 1:仅群主
     * @var int
     */
    private $mentionAllAuthority = 0;
    /**
     * 管理类型 0:默认,所有人可管理 1:仅群主可管理
     * @var int
     */
    private $managementType = 0;

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
     * @param string $chatId
     * @throws \SyException\DingDing\TalkException
     */
    public function setChatId(string $chatId)
    {
        if (ctype_alnum($chatId)) {
            $this->reqData['chatid'] = $chatId;
        } else {
            throw new TalkException('会话ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $name
     * @throws \SyException\DingDing\TalkException
     */
    public function setName(string $name)
    {
        if (strlen($name) > 0) {
            $this->reqData['name'] = mb_substr($name, 0, 10);
        } else {
            throw new TalkException('群名称不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $owner
     * @throws \SyException\DingDing\TalkException
     */
    public function setOwner(string $owner)
    {
        if (ctype_alnum($owner)) {
            $this->reqData['owner'] = $owner;
        } else {
            throw new TalkException('群主不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param array $userList
     * @throws \SyException\DingDing\TalkException
     */
    public function setAddUserList(array $userList)
    {
        $users = [];
        foreach ($userList as $eUserId) {
            if (ctype_alnum($eUserId)) {
                $users[$eUserId] = 1;
            }
        }

        $userNum = count($users);
        if ($userNum == 0) {
            throw new TalkException('添加成员列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        } elseif ($userNum > 40) {
            throw new TalkException('添加成员不能超过40个', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['add_useridlist'] = array_keys($users);
    }

    /**
     * @param array $userList
     * @throws \SyException\DingDing\TalkException
     */
    public function setDelUserList(array $userList)
    {
        $users = [];
        foreach ($userList as $eUserId) {
            if (ctype_alnum($eUserId)) {
                $users[$eUserId] = 1;
            }
        }

        $userNum = count($users);
        if ($userNum == 0) {
            throw new TalkException('删除成员列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        } elseif ($userNum > 40) {
            throw new TalkException('删除成员不能超过40个', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['del_useridlist'] = array_keys($users);
    }

    /**
     * @param string $icon
     * @throws \SyException\DingDing\TalkException
     */
    public function setIcon(string $icon)
    {
        if (strlen($icon) > 0) {
            $this->reqData['icon'] = $icon;
        } else {
            throw new TalkException('群头像不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param bool $isBan
     */
    public function setIsBan(bool $isBan)
    {
        $this->reqData['isBan'] = $isBan;
    }

    /**
     * @param int $searchable
     * @throws \SyException\DingDing\TalkException
     */
    public function setSearchable(int $searchable)
    {
        if (in_array($searchable, [0, 1], true)) {
            $this->reqData['searchable'] = $searchable;
        } else {
            throw new TalkException('搜索类型不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param int $validationType
     * @throws \SyException\DingDing\TalkException
     */
    public function setValidationType(int $validationType)
    {
        if (in_array($validationType, [0, 1], true)) {
            $this->reqData['validationType'] = $validationType;
        } else {
            throw new TalkException('验证类型不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param int $mentionAllAuthority
     * @throws \SyException\DingDing\TalkException
     */
    public function setMentionAllAuthority(int $mentionAllAuthority)
    {
        if (in_array($mentionAllAuthority, [0, 1], true)) {
            $this->reqData['mentionAllAuthority'] = $mentionAllAuthority;
        } else {
            throw new TalkException('通知所有人权限不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param int $managementType
     * @throws \SyException\DingDing\TalkException
     */
    public function setManagementType(int $managementType)
    {
        if (in_array($managementType, [0, 1], true)) {
            $this->reqData['managementType'] = $managementType;
        } else {
            throw new TalkException('管理类型不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['chatid'])) {
            throw new TalkException('会话ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/chat/update?' . http_build_query([
            'access_token' => $this->getAccessToken(TalkBaseCorp::ACCESS_TOKEN_TYPE_CORP, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
