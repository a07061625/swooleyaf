<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-4
 * Time: 下午1:38
 */
namespace DingDing\CorpProvider\User;

use SyConstant\ErrorCode;
use DingDing\TalkBaseCorpProvider;
use DingDing\TalkUtilProvider;
use SyException\DingDing\TalkException;

class AccessCan extends TalkBaseCorpProvider
{
    /**
     * 企业ID
     * @var string
     */
    private $corpId = '';
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 用户ID
     * @var string
     */
    private $userId = '';

    public function __construct(string $corpId)
    {
        parent::__construct();
        $this->corpId = $corpId;
    }

    private function __clone()
    {
    }

    /**
     * @param string $appId
     * @throws \SyException\DingDing\TalkException
     */
    public function setAppId(string $appId)
    {
        if (ctype_alnum($appId)) {
            $this->reqData['appId'] = $appId;
        } else {
            throw new TalkException('应用ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $userId
     * @throws \SyException\DingDing\TalkException
     */
    public function setUserId(string $userId)
    {
        if (ctype_alnum($userId)) {
            $this->reqData['userId'] = $userId;
        } else {
            throw new TalkException('用户ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['appId'])) {
            throw new TalkException('应用ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['userId'])) {
            throw new TalkException('用户ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->reqData['access_token'] = TalkUtilProvider::getAuthorizerAccessToken($this->corpId);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/user/can_access_microapp?' . http_build_query($this->reqData);
        return $this->sendRequest('GET');
    }
}
