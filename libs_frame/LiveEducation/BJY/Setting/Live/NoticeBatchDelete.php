<?php
/**
 * 删除公告
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 8:53
 */
namespace LiveEducation\BJY\Setting\Live;

use LiveEducation\BJY\Setting\BaseSetting;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class NoticeBatchDelete
 * @package LiveEducation\BJY\Setting\Live
 */
class NoticeBatchDelete extends BaseSetting
{
    /**
     * 公告ID列表
     * @var array
     */
    private $ids = [];

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/live_setting/deleteNoticeBatch';
    }

    private function __clone()
    {
    }

    /**
     * @param array $idList
     */
    public function setIdList(array $idList)
    {
        $this->ids = [];
        foreach ($idList as $eId) {
            $trueId = is_numeric($eId) ? (int)$eId : 0;
            if ($trueId > 0) {
                $this->ids[$trueId] = 1;
            }
        }
    }

    public function getDetail() : array
    {
        if (empty($this->ids)) {
            throw new BJYException('公告ID列表不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        $this->reqData['ids'] = implode(',', array_keys($this->ids));
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
