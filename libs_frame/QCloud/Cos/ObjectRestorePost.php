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
use Tool\Tool;

/**
 * 恢复archive类型的对象
 * @package QCloud\Cos
 */
class ObjectRestorePost extends CloudBaseCos
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
        $this->setReqMethod(self::REQ_METHOD_POST);
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
            $this->reqUri = '/' . $objectKey . '?restore';
            $this->objectKey = $objectKey;
            $this->signParams['restore'] = '';
        } else {
            throw new CosException('对象名称不合法', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
    }

    /**
     * @param array $restoreConfig
     * @throws \SyException\QCloud\CosException
     */
    public function setRestoreConfig(array $restoreConfig)
    {
        if (empty($restoreConfig)) {
            throw new CosException('恢复配置不合法', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }

        $this->reqData = $restoreConfig;
    }

    public function getDetail() : array
    {
        if (strlen($this->objectKey) == 0) {
            throw new CosException('对象名称不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
        if (empty($this->reqData)) {
            throw new CosException('恢复配置不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::arrayToXml($this->reqData, 2);

        return $this->getContent();
    }
}
