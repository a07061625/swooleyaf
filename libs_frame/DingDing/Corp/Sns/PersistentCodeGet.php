<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-28
 * Time: 上午11:15
 */
namespace DingDing\Corp\Sns;

use SyConstant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use DingDing\TalkUtilCorp;
use DingDing\TalkUtilProvider;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 获取用户的持久授权码
 * @package DingDing\Corp\Sns
 */
class PersistentCodeGet extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 临时授权码
     * @var string
     */
    private $tmp_auth_code = '';

    public function __construct(string $corpId)
    {
        parent::__construct();
        $this->_corpId = $corpId;
    }

    private function __clone()
    {
    }

    /**
     * @param string $tmpAuthCode
     * @throws \SyException\DingDing\TalkException
     */
    public function setTmpAuthCode(string $tmpAuthCode)
    {
        if (ctype_alnum($tmpAuthCode)) {
            $this->reqData['tmp_auth_code'] = $tmpAuthCode;
        } else {
            throw new TalkException('临时授权码不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['tmp_auth_code'])) {
            throw new TalkException('临时授权码不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        if (strlen($this->_corpId) > 0) {
            $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/sns/get_persistent_code?' . http_build_query([
                'access_token' => TalkUtilCorp::getSnsToken($this->_corpId),
            ]);
        } else {
            $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/sns/get_persistent_code?' . http_build_query([
                'access_token' => TalkUtilProvider::getSnsToken(),
            ]);
        }
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
