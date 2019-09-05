<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-4
 * Time: 下午12:42
 */
namespace DingDing\Corp\Media;

use SyConstant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;

/**
 * 上传媒体文件
 * @package DingDing\Corp\Media
 */
class MediaUpload extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 文件类型
     * @var string
     */
    private $type = '';

    /**
     * 文件全路径,包括文件名
     * @var string
     */
    private $file_path = '';

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
     * @param string $type
     * @throws \SyException\DingDing\TalkException
     */
    public function setType(string $type)
    {
        if (isset(self::$totalMediaType[$type])) {
            $this->type = $type;
        } else {
            throw new TalkException('文件类型不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $filePath
     * @throws \SyException\DingDing\TalkException
     */
    public function setFilePath(string $filePath)
    {
        if (file_exists($filePath) && is_readable($filePath)) {
            $this->reqData['media'] = new \CURLFile($filePath);
        } else {
            throw new TalkException('文件不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->type) == 0) {
            throw new TalkException('文件类型不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['media'])) {
            throw new TalkException('文件不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/media/upload?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
            'type' => $this->type,
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $this->reqData;
        return $this->sendRequest('POST');
    }
}
