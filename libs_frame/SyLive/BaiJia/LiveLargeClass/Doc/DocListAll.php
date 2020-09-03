<?php
/**
 * 获取账号下上传的所有文档
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 8:55
 */
namespace SyLive\BaiJia\LiveLargeClass\Doc;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class DocListAll
 * @package SyLive\BaiJia\LiveLargeClass\Doc
 */
class DocListAll extends BaseBaiJia
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
     * @throws \SyException\Live\BaiJiaException
     */
    public function setType(string $type)
    {
        if (in_array($type, ['all', 'room', 'api'])) {
            $this->reqData['type'] = $type;
        } else {
            throw new BaiJiaException('上传类型不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['type'])) {
            throw new BaiJiaException('上传类型不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
