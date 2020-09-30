<?php
/**
 * 查询第三方资源抓取任务
 * User: 姜伟
 * Date: 2019/11/22 0022
 * Time: 12:37
 */
namespace SyObjectStorage\Kodo\Object;

use SyCloud\QiNiu\Util;
use SyConstant\ErrorCode;
use SyException\ObjectStorage\KodoException;
use SyObjectStorage\BaseKodo;

class FileFetchQuery extends BaseKodo
{
    /**
     * 存储区域
     *
     * @var string
     */
    private $region = '';
    /**
     * 任务ID
     *
     * @var string
     */
    private $id = '';

    public function __construct(string $accessKey)
    {
        parent::__construct($accessKey);
    }

    private function __clone()
    {
    }

    /**
     * @param string $region
     *
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setRegion(string $region)
    {
        if (isset(self::$totalRegionType[$region])) {
            $this->region = $region;
            $this->setServiceHost('api-' . $region . '.qiniu.com');
        } else {
            throw new KodoException('存储区域不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param string $id
     *
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setId(string $id)
    {
        if (strlen($id) > 0) {
            $this->reqData['id'] = $id;
        } else {
            throw new KodoException('任务ID不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->region) == 0) {
            throw new KodoException('存储区域不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
        if (!isset($this->reqData['id'])) {
            throw new KodoException('任务ID不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }

        $this->serviceUri = '/sisyphus/fetch?' . http_build_query($this->reqData);
        $this->reqHeader['Authorization'] = 'Qiniu ' . Util::createAccessToken($this->accessKey, $this->serviceUri);

        return $this->getContent();
    }
}
