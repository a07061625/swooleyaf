<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-29
 * Time: 下午5:54
 */
namespace DingDing\CorpProvider\Process;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\DingTalkConfigSingleton;
use DingDing\TalkBaseCorpProvider;
use DingDing\TalkUtilProvider;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 复制审批流
 * @package DingDing\CorpProvider\Process
 */
class ProcessCopy extends TalkBaseCorpProvider
{
    /**
     * 企业ID
     * @var string
     */
    private $corpId = '';
    /**
     * 应用ID
     * @var int
     */
    private $agent_id = 0;
    /**
     * 审批码
     * @var string
     */
    private $process_code = '';
    /**
     * 业务分类标识
     * @var string
     */
    private $biz_category_id = '';
    /**
     * 审批流名称
     * @var string
     */
    private $process_name = '';
    /**
     * 审批流描述
     * @var string
     */
    private $description = '';

    public function __construct(string $corpId)
    {
        parent::__construct();
        $this->corpId = $corpId;
        $this->reqData['agent_id'] = DingTalkConfigSingleton::getInstance()->getCorpProviderConfig()->getSuiteId();
    }

    private function __clone()
    {
    }

    /**
     * @param string $processCode
     * @throws \SyException\DingDing\TalkException
     */
    public function setProcessCode(string $processCode)
    {
        if (strlen($processCode) > 0) {
            $this->reqData['process_code'] = $processCode;
        } else {
            throw new TalkException('审批码不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $bizCategoryId
     * @throws \SyException\DingDing\TalkException
     */
    public function setBizCategoryId(string $bizCategoryId)
    {
        if (ctype_alnum($bizCategoryId) && (strlen($bizCategoryId) <= 64)) {
            $this->reqData['biz_category_id'] = $bizCategoryId;
        } else {
            throw new TalkException('业务分类标识不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $processName
     * @throws \SyException\DingDing\TalkException
     */
    public function setProcessName(string $processName)
    {
        if (strlen($processName) > 0) {
            $this->reqData['process_name'] = mb_substr($processName, 0, 32);
        } else {
            throw new TalkException('名称不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $description
     * @throws \SyException\DingDing\TalkException
     */
    public function setDescription(string $description)
    {
        if (strlen($description) > 0) {
            $this->reqData['description'] = $description;
        } else {
            throw new TalkException('描述不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['process_code'])) {
            throw new TalkException('审批码不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['biz_category_id'])) {
            throw new TalkException('业务分类标识不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['process_name'])) {
            throw new TalkException('名称不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['description'])) {
            throw new TalkException('描述不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/topapi/process/copy?' . http_build_query([
            'access_token' => TalkUtilProvider::getAuthorizerAccessToken($this->corpId),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
