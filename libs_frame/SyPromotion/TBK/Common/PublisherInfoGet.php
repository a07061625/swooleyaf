<?php
/**
 * 查询私域用户备案信息
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:38
 */

namespace SyPromotion\TBK\Common;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetPageNo2Trait;
use SyPromotion\TBK\Traits\SetPageSizeTrait;

/**
 * Class PublisherInfoGet
 *
 * @package SyPromotion\TBK\Common
 */
class PublisherInfoGet extends BaseTBK
{
    use SetPageNo2Trait;
    use SetPageSizeTrait;

    /**
     * 类型 1:渠道信息 2:会员信息
     *
     * @var int
     */
    private $info_type = 0;
    /**
     * 渠道关系ID
     *
     * @var int
     */
    private $relation_id = 0;
    /**
     * 页数
     *
     * @var int
     */
    private $page_no = 0;
    /**
     * 每页记录数
     *
     * @var int
     */
    private $page_size = 0;
    /**
     * 备案场景
     *
     * @var string
     */
    private $relation_app = '';
    /**
     * 会员运营ID
     *
     * @var string
     */
    private $special_id = '';
    /**
     * 外部用户标记
     *
     * @var string
     */
    private $external_id = '';
    /**
     * 外部用户类型
     *
     * @var int
     */
    private $external_type = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.sc.publisher.info.get');
        $this->reqData['page_no'] = 1;
        $this->reqData['page_size'] = 20;
        $this->reqData['relation_app'] = 'common';
        $this->reqData['external_type'] = 0;
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setInfoType(int $infoType)
    {
        if (\in_array($infoType, [1, 2])) {
            $this->reqData['info_type'] = $infoType;
        } else {
            throw new TBKException('类型不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setRelationId(int $relationId)
    {
        if ($relationId > 0) {
            $this->reqData['relation_id'] = $relationId;
        } else {
            throw new TBKException('渠道关系ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setRelationApp(string $relationApp)
    {
        if (\in_array($relationApp, ['common', 'etao', 'minietao', 'offlineShop', 'offlinePerson'])) {
            $this->reqData['relation_app'] = $relationApp;
        } else {
            throw new TBKException('备案场景不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setSpecialId(string $specialId)
    {
        if (\strlen($specialId) > 0) {
            $this->reqData['special_id'] = $specialId;
        } else {
            throw new TBKException('会员运营ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setExternalId(string $externalId)
    {
        if (\strlen($externalId) > 0) {
            $this->reqData['external_id'] = $externalId;
        } else {
            throw new TBKException('外部用户标记不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setExternalType(int $externalType)
    {
        if (\in_array($externalType, [0, 1, 2, 3, 4, 5])) {
            $this->reqData['external_type'] = $externalType;
        } else {
            throw new TBKException('外部用户类型不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['info_type'])) {
            throw new TBKException('类型不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
