<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-28
 * Time: 上午11:15
 */
namespace DingDing\Corp\User;

use SyConstant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;

/**
 * 根据unionid获取userid
 * @package DingDing\Corp\User
 */
class UnionIdToUserId extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 唯一标识
     * @var string
     */
    private $unionid = '';

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
     * @param string $unionId
     * @throws \SyException\DingDing\TalkException
     */
    public function setUnionId(string $unionId)
    {
        if (strlen($unionId) > 0) {
            $this->reqData['unionid'] = $unionId;
        } else {
            throw new TalkException('唯一标识不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['unionid'])) {
            throw new TalkException('唯一标识不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->reqData['access_token'] = $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/user/getUseridByUnionid?' . http_build_query($this->reqData);
        return $this->sendRequest('GET');
    }
}
