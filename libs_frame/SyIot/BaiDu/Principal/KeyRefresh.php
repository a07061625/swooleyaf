<?php
/**
 * 重新生成密钥
 * User: 姜伟
 * Date: 2019/7/17 0017
 * Time: 17:14
 */
namespace SyIot\BaiDu\Principal;

use SyConstant\ErrorCode;
use SyException\Iot\BaiDuIotException;
use SyIot\BaseBaiDu;
use SyIot\UtilBaiDu;
use SyTool\Tool;

class KeyRefresh extends BaseBaiDu
{
    /**
     * endpoint名称
     *
     * @var string
     */
    private $endpointName = '';
    /**
     * principal名称
     *
     * @var string
     */
    private $principalName = '';
    /**
     * 生成类型
     *
     * @var string
     */
    private $target = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqData['target'] = 'all';
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
     * @param string $principalName
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setPrincipalName(string $principalName)
    {
        if (ctype_alnum($principalName)) {
            $this->principalName = $principalName;
        } else {
            throw new BaiDuIotException('principal名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $target
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setTarget(string $target)
    {
        if (in_array($target, ['all', 'password', 'cert'])) {
            $this->reqData['target'] = $target;
        } else {
            throw new BaiDuIotException('生成类型不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->endpointName) == 0) {
            throw new BaiDuIotException('endpoint名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (strlen($this->principalName) == 0) {
            throw new BaiDuIotException('principal名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        $this->serviceUri = '/v1/endpoint/' . $this->endpointName . '/principal/' . $this->principalName;

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
