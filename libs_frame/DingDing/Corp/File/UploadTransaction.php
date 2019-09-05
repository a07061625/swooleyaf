<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-11
 * Time: 下午5:12
 */
namespace DingDing\Corp\File;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\DingTalkConfigSingleton;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;

/**
 * 分块上传事务
 * @package DingDing\Corp\File
 */
class UploadTransaction extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 应用ID
     * @var string
     */
    private $agent_id = '';
    /**
     * 文件大小
     * @var int
     */
    private $file_size = 0;
    /**
     * 文件总块数
     * @var int
     */
    private $chunk_numbers = 0;
    /**
     * 上传事务id,没有设置是开启事务,设置了是提交事务
     * @var string
     */
    private $upload_id = '';

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
     * @param int $fileSize
     * @throws \SyException\DingDing\TalkException
     */
    public function setFileSize(int $fileSize)
    {
        if ($fileSize >= 102400) {
            $this->reqData['file_size'] = $fileSize;
        } else {
            throw new TalkException('文件大小不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param int $chunkNumbers
     * @throws \SyException\DingDing\TalkException
     */
    public function setChunkNumbers(int $chunkNumbers)
    {
        if (($chunkNumbers > 0) && ($chunkNumbers <= 10000)) {
            $this->reqData['chunk_numbers'] = $chunkNumbers;
        } else {
            throw new TalkException('文件总块数不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $uploadId
     * @throws \SyException\DingDing\TalkException
     */
    public function setUploadId(string $uploadId)
    {
        if (strlen($uploadId) > 0) {
            $this->upload_id = $uploadId;
        } else {
            throw new TalkException('上传事务id不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['file_size'])) {
            throw new TalkException('文件大小不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['chunk_numbers'])) {
            throw new TalkException('文件总块数不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->reqData['access_token'] = $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/file/upload/transaction?' . http_build_query($this->reqData);
        return $this->sendRequest('GET');
    }
}
