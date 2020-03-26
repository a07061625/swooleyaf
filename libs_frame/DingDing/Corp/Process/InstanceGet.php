<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-30
 * Time: 上午11:10
 */
namespace DingDing\Corp\Process;

use SyConstant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 获取单个审批实例
 * @package DingDing\Corp\Process
 */
class InstanceGet extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 审批实例id
     * @var string
     */
    private $process_instance_id = '';

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
     * @param string $processInstanceId
     * @throws \SyException\DingDing\TalkException
     */
    public function setProcessInstanceId(string $processInstanceId)
    {
        if (strlen($processInstanceId) > 0) {
            $this->reqData['process_instance_id'] = $processInstanceId;
        } else {
            throw new TalkException('实例id不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['process_instance_id'])) {
            throw new TalkException('实例id不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/topapi/processinstance/get?' . http_build_query([
            'access_token' => $this->getAccessToken(TalkBaseCorp::ACCESS_TOKEN_TYPE_CORP, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
