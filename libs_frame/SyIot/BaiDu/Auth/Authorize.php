<?php
/**
 * 鉴权
 * User: 姜伟
 * Date: 2019/7/17 0017
 * Time: 17:14
 */
namespace SyIot\BaiDu\Auth;

use SyConstant\ErrorCode;
use SyException\Iot\BaiDuIotException;
use SyIot\BaseBaiDu;
use SyIot\UtilBaiDu;
use SyTool\Tool;

class Authorize extends BaseBaiDu
{
    /**
     * 用户uuid
     *
     * @var string
     */
    private $principalUuid = '';
    /**
     * 操作
     *
     * @var string
     */
    private $action = '';
    /**
     * 主题名
     *
     * @var string
     */
    private $topic = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/v1/auth/authorize';
    }

    private function __clone()
    {
    }

    /**
     * @param string $principalUuid
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setPrincipalUuid(string $principalUuid)
    {
        if (strlen($principalUuid) > 0) {
            $this->reqData['principalUuid'] = $principalUuid;
        } else {
            throw new BaiDuIotException('用户uuid不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $action
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setAction(string $action)
    {
        if (in_array($action, ['CONNECT', 'CREATE', 'SEND', 'RECEIVE', 'CONSUME'])) {
            $this->reqData['action'] = $action;
        } else {
            throw new BaiDuIotException('操作不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $topic
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setTopic(string $topic)
    {
        if (strlen($topic) > 0) {
            $this->reqData['topic'] = $topic;
        } else {
            throw new BaiDuIotException('主题名不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['principalUuid'])) {
            throw new BaiDuIotException('用户uuid不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['action'])) {
            throw new BaiDuIotException('操作不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (in_array($this->reqData['action'], ['SEND', 'RECEIVE', 'CONSUME']) && !isset($this->reqData['topic'])) {
            throw new BaiDuIotException('主题名不能为空', ErrorCode::IOT_PARAM_ERROR);
        }

        $this->reqHeader['Authorization'] = UtilBaiDu::createSign([
            'req_method' => self::REQ_METHOD_POST,
            'req_uri' => $this->serviceUri,
            'req_params' => [],
            'req_headers' => [
                'host',
            ],
        ]);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceProtocol . '://' . $this->serviceDomain . $this->serviceUri;
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);

        return $this->getContent();
    }
}
