<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-5
 * Time: 下午2:35
 */
namespace DingDing\Corp\User;

use SyConstant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;

/**
 * 获取企业员工人数
 * @package DingDing\Corp\User
 */
class OrgUserCountGet extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 激活钉钉标识 0:包含未激活钉钉的人员数量 1:不包含未激活钉钉的人员数量
     * @var int
     */
    private $onlyActive = 0;

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
     * @param int $onlyActive
     * @throws \SyException\DingDing\TalkException
     */
    public function setOnlyActive(int $onlyActive)
    {
        if (in_array($onlyActive, [0, 1], true)) {
            $this->reqData['onlyActive'] = $onlyActive;
        } else {
            throw new TalkException('激活钉钉标识不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['onlyActive'])) {
            throw new TalkException('激活钉钉标识不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->reqData['access_token'] = $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/user/get_org_user_count?' . http_build_query($this->reqData);
        return $this->sendRequest('GET');
    }
}
