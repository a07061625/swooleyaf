<?php
/**
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 18:24
 */
namespace QCloud\Cos;

use Constant\ErrorCode;
use SyException\QCloud\CosException;
use QCloud\CloudBaseCos;

/**
 * 设置对象的访问权限
 * @package QCloud\Cos
 */
class ObjectAclPut extends CloudBaseCos
{
    /**
     * 对象名称
     * @var string
     */
    private $objectKey = '';

    public function __construct()
    {
        parent::__construct();
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_PUT);
    }

    private function __clone()
    {
    }

    /**
     * @param string $objectKey
     * @throws \SyException\QCloud\CosException
     */
    public function setObjectKey(string $objectKey)
    {
        if (strlen($objectKey) > 0) {
            $this->reqUri = '/' . $objectKey . '?acl';
            $this->objectKey = $objectKey;
            $this->signParams['acl'] = '';
        } else {
            throw new CosException('对象名称不合法', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
    }

    /**
     * @param string $aclConfig
     * @throws \SyException\QCloud\CosException
     */
    public function setAclConfig(string $aclConfig)
    {
        if (strlen($aclConfig) > 0) {
            $this->reqData['acl_config'] = $aclConfig;
        } else {
            throw new CosException('ACL配置不合法', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->objectKey) == 0) {
            throw new CosException('对象名称不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
        if (!isset($this->reqData['acl_config'])) {
            throw new CosException('ACL配置不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $this->reqData['acl_config'];

        return $this->getContent();
    }
}
