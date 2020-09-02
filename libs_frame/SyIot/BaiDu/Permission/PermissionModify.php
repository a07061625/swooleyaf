<?php
/**
 * 更新已有的topic设置
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

class PermissionModify extends BaseBaiDu
{
    /**
     * endpoint名称
     *
     * @var string
     */
    private $endpointName = '';
    /**
     * permissionID
     *
     * @var string
     */
    private $permissionUuid = '';
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
        } else {
            throw new BaiDuIotException('endpoint名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $permissionUuid
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setPermissionUuid(string $permissionUuid)
    {
        if (strlen($permissionUuid) > 0) {
            $this->permissionUuid = $permissionUuid;
        } else {
            throw new BaiDuIotException('permissionID不合法', ErrorCode::IOT_PARAM_ERROR);
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
        if (strlen($this->permissionUuid) == 0) {
            throw new BaiDuIotException('permissionID不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['topic'])) {
            throw new BaiDuIotException('主题名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (empty($this->operations)) {
            throw new BaiDuIotException('操作列表不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        $this->reqData['operations'] = array_keys($this->operations);
        $this->serviceUri = '/v1/endpoint/' . $this->endpointName . '/permission/' . $this->permissionUuid;

        $this->reqHeader['Authorization'] = UtilBaiDu::createSign([
            'req_method' => self::REQ_METHOD_PUT,
            'req_uri' => $this->serviceUri,
            'req_params' => [],
            'req_headers' => [
                'host',
            ],
        ]);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceProtocol . '://' . $this->serviceDomain . $this->serviceUri;
        $this->curlConfigs[CURLOPT_CUSTOMREQUEST] = self::REQ_METHOD_PUT;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);

        return $this->getContent();
    }
}
