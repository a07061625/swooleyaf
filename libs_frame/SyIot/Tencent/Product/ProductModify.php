<?php
/**
 * 修改产品
 * User: 姜伟
 * Date: 2019/7/24 0024
 * Time: 14:07
 */
namespace SyIot\Tencent\Product;

use DesignPatterns\Singletons\IotConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Iot\TencentIotException;
use SyIot\BaseTencent;

class ProductModify extends BaseTencent
{
    /**
     * 产品ID
     *
     * @var string
     */
    private $ProductId = '';
    /**
     * 产品名称
     *
     * @var string
     */
    private $ProductName = '';
    /**
     * 产品描述
     *
     * @var string
     */
    private $ProductDesc = '';
    /**
     * 模型ID
     *
     * @var int
     */
    private $ModuleId = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'ModifyStudioProduct';
    }

    private function __clone()
    {
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
     * @param string $productName
     *
     * @throws \SyException\Iot\TencentIotException
     */
    public function setProductName(string $productName)
    {
        if (strlen($productName) > 0) {
            $this->reqData['ProductName'] = $productName;
        } else {
            throw new TencentIotException('产品名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $productDesc
     *
     * @throws \SyException\Iot\TencentIotException
     */
    public function setProductDesc(string $productDesc)
    {
        if (strlen($productDesc) > 0) {
            $this->reqData['ProductDesc'] = $productDesc;
        } else {
            throw new TencentIotException('产品描述不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param int $moduleId
     *
     * @throws \SyException\Iot\TencentIotException
     */
    public function setModuleId(int $moduleId)
    {
        if ($moduleId > 0) {
            $this->reqData['ModuleId'] = $moduleId;
        } else {
            throw new TencentIotException('模型ID不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['ProductId'])) {
            throw new TencentIotException('产品ID不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['ProjectName'])) {
            throw new TencentIotException('产品名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['ProjectDesc'])) {
            throw new TencentIotException('产品描述不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['ModuleId'])) {
            throw new TencentIotException('模型ID不能为空', ErrorCode::IOT_PARAM_ERROR);
        }

        $config = IotConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
