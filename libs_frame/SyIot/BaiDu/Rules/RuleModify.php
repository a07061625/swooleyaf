<?php
/**
 * 修改规则
 * User: 姜伟
 * Date: 2019/7/18 0018
 * Time: 23:59
 */
namespace SyIot\BaiDu\Rules;

use SyConstant\ErrorCode;
use SyException\Iot\BaiDuIotException;
use SyIot\BaseBaiDu;
use SyIot\UtilBaiDu;
use SyTool\Tool;

class RuleModify extends BaseBaiDu
{
    /**
     * 设备名称
     *
     * @var string
     */
    private $deviceName = '';
    /**
     * 规则名称
     *
     * @var string
     */
    private $name = '';
    /**
     * 存储数据配置列表
     *
     * @var array
     */
    private $sources = [];
    /**
     * 写入数据配置列表
     *
     * @var array
     */
    private $destinations = [];

    public function __construct()
    {
        parent::__construct();
    }

    private function __clone()
    {
    }

    /**
     * @param string $deviceName
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setDeviceName(string $deviceName)
    {
        if (ctype_alnum($deviceName)) {
            $this->deviceName = $deviceName;
            $this->serviceUri = '/v3/iot/rules/device/' . $deviceName;
        } else {
            throw new BaiDuIotException('设备名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $name
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setName(string $name)
    {
        if (strlen($name) > 0) {
            $this->reqData['name'] = $name;
        } else {
            throw new BaiDuIotException('规则名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param array $source
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function addSource(array $source)
    {
        if (empty($source)) {
            throw new BaiDuIotException('存储数据配置不合法', ErrorCode::IOT_PARAM_ERROR);
        }
        $this->sources[] = $source;
    }

    /**
     * @param array $destination
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function addDestination(array $destination)
    {
        if (empty($destination)) {
            throw new BaiDuIotException('写入数据配置不合法', ErrorCode::IOT_PARAM_ERROR);
        }

        $this->destinations[] = $destination;
    }

    public function getDetail() : array
    {
        if (strlen($this->deviceName) == 0) {
            throw new BaiDuIotException('设备名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if ((!isset($this->reqData['name'])) && empty($this->sources) && empty($this->destinations)) {
            throw new BaiDuIotException('规则名称,存储数据配置和写入数据配置不能都为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!empty($this->sources)) {
            $this->reqData['sources'] = $this->sources;
        }
        if (!empty($this->destinations)) {
            $this->reqData['destinations'] = $this->destinations;
        }

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
