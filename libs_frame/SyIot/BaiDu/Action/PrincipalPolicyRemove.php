<?php
/**
 * 从一个Principal移除一个Policy
 * User: 姜伟
 * Date: 2019/7/17 0017
 * Time: 17:14
 */
namespace SyIot\BaiDu\Action;

use SyConstant\ErrorCode;
use SyException\Iot\BaiDuIotException;
use SyIot\BaseBaiDu;
use SyIot\UtilBaiDu;
use SyTool\Tool;

class PrincipalPolicyRemove extends BaseBaiDu
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
     * policy名称
     *
     * @var string
     */
    private $policyName = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/v1/action/remove-principal-policy';
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
            $this->reqData['endpointName'] = $endpointName;
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
            $this->reqData['principalName'] = $principalName;
        } else {
            throw new BaiDuIotException('principal名称不合法', ErrorCode::IOT_PARAM_ERROR);
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

    public function getDetail() : array
    {
        if (!isset($this->reqData['endpointName'])) {
            throw new BaiDuIotException('endpoint名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['principalName'])) {
            throw new BaiDuIotException('principal名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['policyName'])) {
            throw new BaiDuIotException('policy名称不能为空', ErrorCode::IOT_PARAM_ERROR);
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
