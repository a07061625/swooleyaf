<?php
/**
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 18:24
 */
namespace SyObjectStorage\Cos\Object;

use SyConstant\ErrorCode;
use SyException\ObjectStorage\CosException;
use SyObjectStorage\BaseCos;
use SyTool\Tool;

/**
 * 批量删除Object
 *
 * @package SyObjectStorage\Cos\Object
 */
class MultipleDelete extends BaseCos
{
    public function __construct(string $appId)
    {
        parent::__construct($appId);
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
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    public function setDeleteInfo(array $deleteInfo)
    {
        if (empty($deleteInfo)) {
            throw new CosException('删除信息不能为空', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }

        $this->reqData = $deleteInfo;
    }

    public function getDetail() : array
    {
        if (empty($this->reqData)) {
            throw new CosException('删除信息不能为空', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
        $content = Tool::arrayToXml($this->reqData, 2);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $content;
        $this->reqHeader['Content-Length'] = strlen($content);
        $this->reqHeader['Content-MD5'] = md5(base64_encode($content));

        return $this->getContent();
    }
}
