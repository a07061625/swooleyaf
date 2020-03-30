<?php
/**
 * 获取账号下上传的所有文档
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 8:55
 */
namespace LiveEducation\BJY\Live\LargeClass\Doc;

use LiveEducation\BaseBJY;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class DocListAll
 * @package LiveEducation\BJY\Live\LargeClass\Doc
 */
class DocListAll extends BaseBJY
{
    /**
     * 上传类型 all:所有文档 room:教室里上传的文件 api:从api接口上传的文档
     * @var string
     */
    private $type = '';

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/doc/listAllDoc';
    }

    private function __clone()
    {
    }

    /**
     * @param string $type
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setType(string $type)
    {
        if (in_array($type, ['all', 'room', 'api'])) {
            $this->reqData['type'] = $type;
        } else {
            throw new BJYException('上传类型不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['type'])) {
            throw new BJYException('上传类型不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
