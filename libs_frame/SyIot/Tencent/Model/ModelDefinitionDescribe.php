<?php
/**
 * 查询产品数据模板
 * User: 姜伟
 * Date: 2019/7/24 0024
 * Time: 14:07
 */
namespace SyIot\Tencent\Model;

use SyConstant\ErrorCode;
use SyException\Iot\TencentIotException;
use SyIot\IotBaseTencent;

class ModelDefinitionDescribe extends IotBaseTencent
{
    /**
     * 产品ID
     * @var string
     */
    private $ProductId = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeModelDefinition';
        $this->reqHeader['X-TC-Version'] = '2019-04-23';
    }

    private function __clone()
    {
    }

    /**
     * @param string $productId
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

    public function getDetail() : array
    {
        if (!isset($this->reqData['ProductId'])) {
            throw new TencentIotException('产品ID不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        $this->addReqSign();
        return $this->getContent();
    }
}
