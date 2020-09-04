<?php
/**
 * 获取产品列表
 * User: 姜伟
 * Date: 2019/7/24 0024
 * Time: 14:07
 */
namespace SyIot\Tencent\Product;

use DesignPatterns\Singletons\IotConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Iot\TencentIotException;
use SyIot\BaseTencent;

class ProductListGet extends BaseTencent
{
    /**
     * 项目ID
     *
     * @var int
     */
    private $ProjectId = 0;
    /**
     * 开发状态
     *
     * @var string
     */
    private $DevStatus = '';
    /**
     * 偏移量
     *
     * @var int
     */
    private $Offset = 0;
    /**
     * 每页个数
     *
     * @var int
     */
    private $Limit = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'GetStudioProductList';
        $this->reqData['Offset'] = 0;
        $this->reqData['Limit'] = 10;
    }

    private function __clone()
    {
    }

    /**
     * @param int $projectId
     *
     * @throws \SyException\Iot\TencentIotException
     */
    public function setProjectId(int $projectId)
    {
        if ($projectId > 0) {
            $this->reqData['ProjectId'] = $projectId;
        } else {
            throw new TencentIotException('项目ID不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $devStatus
     *
     * @throws \SyException\Iot\TencentIotException
     */
    public function setDevStatus(string $devStatus)
    {
        if (strlen($devStatus) > 0) {
            $this->reqData['DevStatus'] = $devStatus;
        } else {
            throw new TencentIotException('开发状态不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param int $offset
     *
     * @throws \SyException\Iot\TencentIotException
     */
    public function setOffset(int $offset)
    {
        if ($offset >= 0) {
            $this->reqData['Offset'] = $offset;
        } else {
            throw new TencentIotException('偏移量不合法', ErrorCode::IOT_PARAM_ERROR);
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
            throw new TencentIotException('每页个数不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['ProjectId'])) {
            throw new TencentIotException('项目ID不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['DevStatus'])) {
            throw new TencentIotException('开发状态不能为空', ErrorCode::IOT_PARAM_ERROR);
        }

        $config = IotConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
