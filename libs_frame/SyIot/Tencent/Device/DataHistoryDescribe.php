<?php
/**
 * 获取设备历史数据
 * User: 姜伟
 * Date: 2019/7/24 0024
 * Time: 14:07
 */
namespace SyIot\Tencent\Device;

use DesignPatterns\Singletons\IotConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Iot\TencentIotException;
use SyIot\BaseTencent;

class DataHistoryDescribe extends BaseTencent
{
    /**
     * 开始时间
     *
     * @var int
     */
    private $MinTime = 0;
    /**
     * 结束时间
     *
     * @var int
     */
    private $MaxTime = 0;
    /**
     * 产品ID
     *
     * @var string
     */
    private $ProductId = '';
    /**
     * 设备名称
     *
     * @var string
     */
    private $DeviceName = '';
    /**
     * 属性字段名称
     *
     * @var string
     */
    private $FieldName = '';
    /**
     * 返回记录数
     *
     * @var int
     */
    private $Limit = 0;
    /**
     * 检索上下文
     *
     * @var string
     */
    private $Context = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeDeviceDataHistory';
        $this->reqData['Limit'] = 10;
    }

    private function __clone()
    {
    }

    /**
     * @param int $minTime
     * @param int $maxTime
     *
     * @throws \SyException\Iot\TencentIotException
     */
    public function setMinAndMaxTime(int $minTime, int $maxTime)
    {
        if ($minTime <= 1000000000) {
            throw new TencentIotException('开始时间不合法', ErrorCode::IOT_PARAM_ERROR);
        } elseif ($minTime >= $maxTime) {
            throw new TencentIotException('开始时间必须小于结束时间', ErrorCode::IOT_PARAM_ERROR);
        }
        $this->reqData['MinTime'] = $minTime * 1000;
        $this->reqData['MaxTime'] = $maxTime * 1000;
    }

    /**
     * @param string $productId
     *
     * @throws \SyException\Iot\TencentIotException
     */
    public function setProductId(string $productId)
    {
        if (ctype_alnum($productId)) {
            $this->reqData['ProductId'] = $productId;
        } else {
            throw new TencentIotException('产品ID不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $deviceName
     *
     * @throws \SyException\Iot\TencentIotException
     */
    public function setDeviceName(string $deviceName)
    {
        if (strlen($deviceName) > 0) {
            $this->reqData['DeviceName'] = $deviceName;
        } else {
            throw new TencentIotException('设备名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $fieldName
     *
     * @throws \SyException\Iot\TencentIotException
     */
    public function setFieldName(string $fieldName)
    {
        if (strlen($fieldName) > 0) {
            $this->reqData['FieldName'] = $fieldName;
        } else {
            throw new TencentIotException('属性字段名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param int $limit
     *
     * @throws \SyException\Iot\TencentIotException
     */
    public function setLimit(int $limit)
    {
        if ($limit > 0) {
            $this->reqData['Limit'] = $limit;
        } else {
            throw new TencentIotException('返回记录数不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $context
     */
    public function setContext(string $context)
    {
        $this->reqData['Context'] = trim($context);
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['MinTime'])) {
            throw new TencentIotException('开始时间不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['ProductId'])) {
            throw new TencentIotException('产品ID不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['DeviceName'])) {
            throw new TencentIotException('设备名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['FieldName'])) {
            throw new TencentIotException('属性字段名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }

        $config = IotConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
