<?php
/**
 * 新建产品
 * User: 姜伟
 * Date: 2019/7/24 0024
 * Time: 14:07
 */
namespace SyIot\Tencent\Product;

use DesignPatterns\Singletons\IotConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Iot\TencentIotException;
use SyIot\BaseTencent;

class ProductCreate extends BaseTencent
{
    /**
     * 产品名称
     *
     * @var string
     */
    private $ProductName = '';
    /**
     * 分组模板ID
     *
     * @var int
     */
    private $CategoryId = 0;
    /**
     * 产品类型
     *
     * @var int
     */
    private $ProductType = 0;
    /**
     * 加密类型
     *
     * @var string
     */
    private $EncryptionType = '';
    /**
     * 连接类型
     *
     * @var string
     */
    private $NetType = '';
    /**
     * 数据协议
     *
     * @var int
     */
    private $DataProtocol = 0;
    /**
     * 产品描述
     *
     * @var string
     */
    private $ProductDesc = '';
    /**
     * 项目ID
     *
     * @var int
     */
    private $ProjectId = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'CreateStudioProduct';
    }

    private function __clone()
    {
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
     * @param int $categoryId
     *
     * @throws \SyException\Iot\TencentIotException
     */
    public function setCategoryId(int $categoryId)
    {
        if ($categoryId > 0) {
            $this->reqData['CategoryId'] = $categoryId;
        } else {
            throw new TencentIotException('分组模板ID不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param int $productType
     *
     * @throws \SyException\Iot\TencentIotException
     */
    public function setProductType(int $productType)
    {
        if ($productType > 0) {
            $this->reqData['ProductType'] = $productType;
        } else {
            throw new TencentIotException('产品类型不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $encryptionType
     *
     * @throws \SyException\Iot\TencentIotException
     */
    public function setEncryptionType(string $encryptionType)
    {
        if (strlen($encryptionType) > 0) {
            $this->reqData['EncryptionType'] = $encryptionType;
        } else {
            throw new TencentIotException('加密类型不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $netType
     *
     * @throws \SyException\Iot\TencentIotException
     */
    public function setNetType(string $netType)
    {
        if (strlen($netType) > 0) {
            $this->reqData['NetType'] = $netType;
        } else {
            throw new TencentIotException('连接类型不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param int $dataProtocol
     *
     * @throws \SyException\Iot\TencentIotException
     */
    public function setDataProtocol(int $dataProtocol)
    {
        if ($dataProtocol > 0) {
            $this->reqData['DataProtocol'] = $dataProtocol;
        } else {
            throw new TencentIotException('数据协议不合法', ErrorCode::IOT_PARAM_ERROR);
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

    public function getDetail() : array
    {
        if (!isset($this->reqData['ProductName'])) {
            throw new TencentIotException('产品名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['CategoryId'])) {
            throw new TencentIotException('分组模板ID不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['ProductType'])) {
            throw new TencentIotException('产品类型不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['EncryptionType'])) {
            throw new TencentIotException('加密类型不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['NetType'])) {
            throw new TencentIotException('连接类型不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['DataProtocol'])) {
            throw new TencentIotException('数据协议不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['ProductDesc'])) {
            throw new TencentIotException('产品描述不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['ProjectId'])) {
            throw new TencentIotException('项目ID不能为空', ErrorCode::IOT_PARAM_ERROR);
        }

        $config = IotConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
