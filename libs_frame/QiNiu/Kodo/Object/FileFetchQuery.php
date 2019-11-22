<?php
/**
 * 查询第三方资源抓取任务
 * User: 姜伟
 * Date: 2019/11/22 0022
 * Time: 12:37
 */
namespace QiNiu\Kodo\Object;

use QiNiu\QiNiuBaseKodo;
use QiNiu\QiNiuUtilBase;
use SyConstant\ErrorCode;
use SyException\QiNiu\KodoException;

class FileFetchQuery extends QiNiuBaseKodo
{
    /**
     * 存储区域
     * @var string
     */
    private $region = '';
    /**
     * 任务ID
     * @var string
     */
    private $id = '';

    public function __construct()
    {
        parent::__construct();
    }

    private function __clone()
    {
    }

    /**
     * @param string $region
     * @throws \SyException\QiNiu\KodoException
     */
    public function setRegion(string $region)
    {
        if (isset(self::$totalRegionType[$region])) {
            $this->region = $region;
            $this->setServiceHost('api-' . $region . '.qiniu.com');
        } else {
            throw new KodoException('存储区域不合法', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param string $id
     * @throws \SyException\QiNiu\KodoException
     */
    public function setId(string $id)
    {
        if (strlen($id) > 0) {
            $this->reqData['id'] = $id;
        } else {
            throw new KodoException('任务ID不合法', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->region) == 0) {
            throw new KodoException('存储区域不能为空', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
        if (!isset($this->reqData['id'])) {
            throw new KodoException('任务ID不能为空', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }

        $this->serviceUri = '/sisyphus/fetch?' . http_build_query($this->reqData);
        $this->reqHeader['Authorization'] = 'Qiniu ' . QiNiuUtilBase::createAccessToken($this->serviceUri);
        return $this->getContent();
    }
}
