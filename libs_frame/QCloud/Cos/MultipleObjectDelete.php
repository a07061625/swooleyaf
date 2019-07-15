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
 * 批量删除Object
 * @package QCloud\Cos
 */
class MultipleObjectDelete extends CloudBaseCos
{
    public function __construct()
    {
        parent::__construct();
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_POST);
        $this->reqUri = '/?delete';
        $this->signParams['delete'] = '';
        $this->reqHeader['Content-Type'] = 'application/xml';
    }

    private function __clone()
    {
    }

    /**
     * @param array $deleteInfo
     * @throws \SyException\QCloud\CosException
     */
    public function setDeleteInfo(array $deleteInfo)
    {
        if (empty($deleteInfo)) {
            throw new CosException('删除信息不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }

        $this->reqData = $deleteInfo;
    }

    public function getDetail() : array
    {
        if (empty($this->reqData)) {
            throw new CosException('删除信息不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
        $content = Tool::arrayToXml($this->reqData, 2);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $content;
        $this->reqHeader['Content-Length'] = strlen($content);
        $this->reqHeader['Content-MD5'] = md5(base64_encode($content));

        return $this->getContent();
    }
}
