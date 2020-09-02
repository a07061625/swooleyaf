<?php
/**
 * 在policy下创建topic
 * User: 姜伟
 * Date: 2019/7/17 0017
 * Time: 17:14
 */
namespace SyIot\BaiDu\Permission;

use SyConstant\ErrorCode;
use SyException\Iot\BaiDuIotException;
use SyIot\BaseBaiDu;
use SyIot\UtilBaiDu;
use SyTool\Tool;

class PermissionCreate extends BaseBaiDu
{
    /**
     * endpoint名称
     *
     * @var string
     */
    private $endpointName = '';
    /**
     * policy名称
     *
     * @var string
     */
    private $policyName = '';
    /**
     * 操作列表
     *
     * @var array
     */
    private $operations = [];
    /**
     * 主题名称
     *
     * @var string
     */
    private $topic = '';

    public function __construct()
    {
        parent::__construct();
    }

    private function __clone()
    {
    }

    /**
     * @param string $endpointName
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setEndpointName(string $endpointName)
    {
        if (ctype_alnum($endpointName)) {
            $this->endpointName = $endpointName;
            $this->serviceUri = '/v1/endpoint/' . $endpointName . '/permission';
        } else {
            throw new BaiDuIotException('endpoint名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $policyName
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setPolicyName(string $policyName)
    {
        if (ctype_alnum($policyName)) {
            $this->reqData['policyName'] = $policyName;
        } else {
            throw new BaiDuIotException('policy名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param array $operations
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setOperations(array $operations)
    {
        if (empty($operations)) {
            throw new BaiDuIotException('操作列表不能为空', ErrorCode::IOT_PARAM_ERROR);
        }

        foreach ($operations as $eOperation) {
            if (ctype_alnum($eOperation)) {
                $this->operations[$eOperation] = 1;
            }
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
            throw new BaiDuIotException('主题名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->endpointName) == 0) {
            throw new BaiDuIotException('endpoint名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['policyName'])) {
            throw new BaiDuIotException('policy名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['topic'])) {
            throw new BaiDuIotException('主题名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (empty($this->operations)) {
            throw new BaiDuIotException('操作列表不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        $this->reqData['operations'] = array_keys($this->operations);

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
