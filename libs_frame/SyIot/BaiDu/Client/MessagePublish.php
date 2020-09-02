<?php
/**
 * 消息发布
 * User: 姜伟
 * Date: 2019/7/18 0018
 * Time: 11:57
 */
namespace SyIot\BaiDu\Client;

use SyConstant\ErrorCode;
use SyException\Iot\BaiDuIotException;
use SyIot\BaseBaiDu;
use SyIot\UtilBaiDu;

class MessagePublish extends BaseBaiDu
{
    /**
     * 消息QoS值
     *
     * @var int
     */
    private $qos = 0;
    /**
     * 主题名称
     *
     * @var string
     */
    private $topic = '';
    /**
     * 保留消息标记
     *
     * @var string
     */
    private $retain = '';
    /**
     * 消息内容
     *
     * @var string
     */
    private $msgContent = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/v1/proxy';
        $this->reqHeader['Content-Type'] = 'application/octet-stream';
        $this->qos = 0;
        $this->retain = 'false';
    }

    private function __clone()
    {
    }

    /**
     * @param int $qos
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setQos(int $qos)
    {
        if (in_array($qos, [0, 1])) {
            $this->qos = $qos;
        } else {
            throw new BaiDuIotException('消息QoS值不合法', ErrorCode::IOT_PARAM_ERROR);
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
            $this->topic = $topic;
        } else {
            throw new BaiDuIotException('主题名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $retain
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setRetain(string $retain)
    {
        if (in_array($retain, ['false', 'true'])) {
            $this->retain = $retain;
        } else {
            throw new BaiDuIotException('保留消息标记不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $msgContent
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setMsgContent(string $msgContent)
    {
        if (strlen($msgContent) > 0) {
            $this->msgContent = $msgContent;
        } else {
            throw new BaiDuIotException('消息内容不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $userName
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setUserName(string $userName)
    {
        if (strlen($userName) > 0) {
            $this->reqHeader['auth.username'] = $userName;
        } else {
            throw new BaiDuIotException('用户名不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $password
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setPassword(string $password)
    {
        if (strlen($password) > 0) {
            $this->reqHeader['auth.password'] = $password;
        } else {
            throw new BaiDuIotException('密码不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->topic) == 0) {
            throw new BaiDuIotException('主题名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (strlen($this->msgContent) == 0) {
            throw new BaiDuIotException('消息内容不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqHeader['auth.username'])) {
            throw new BaiDuIotException('用户名不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqHeader['auth.password'])) {
            throw new BaiDuIotException('密码不能为空', ErrorCode::IOT_PARAM_ERROR);
        }

        $domain = $this->serviceDomain;
        $this->serviceDomain = 'api.mqtt.' . $domain;
        $queryData = [
            'qos' => $this->qos,
            'topic' => $this->topic,
            'retain' => $this->retain,
        ];
        $this->reqHeader['Authorization'] = UtilBaiDu::createSign([
            'req_method' => self::REQ_METHOD_POST,
            'req_uri' => $this->serviceUri,
            'req_params' => $queryData,
            'req_headers' => [
                'host',
            ],
        ]);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceProtocol . '://' . $this->serviceDomain . $this->serviceUri . '?' . http_build_query($queryData);
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $this->msgContent;

        return $this->getContent();
    }
}
