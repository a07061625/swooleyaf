<?php
/**
 * 商品链接转换
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */
namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;

/**
 * Class ItemConvert
 * @package SyPromotion\TBK\Promoter
 */
class ItemConvert extends BaseTBK
{
    /**
     * 返回字段列表
     * @var array
     */
    private $fields = [];
    /**
     * 商品ID列表
     * @var array
     */
    private $num_iids = [];
    /**
     * 广告位ID
     * @var int
     */
    private $adzone_id = 0;
    /**
     * 链接形式 1:PC 2:无线 默认１
     * @var int
     */
    private $platform = 0;
    /**
     * 推广渠道
     * @var string
     */
    private $unid = '';
    /**
     * 计划链接
     * @var string
     */
    private $dx = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.item.convert');
        $this->reqData['platform'] = 1;
        $this->reqData['dx'] = '1';
    }

    private function __clone()
    {
    }

    /**
     * @param array $fields
     * @throws \SyException\Promotion\TBKException
     */
    public function setFields(array $fields)
    {
        $this->fields = [];
        foreach ($fields as $eField) {
            $trueField = is_string($eField) ? trim($eField) : '';
            if (strlen($trueField) > 0) {
                $this->fields[$trueField] = 1;
            }
        }
        if (empty($this->fields)) {
            throw new TBKException('返回字段列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $this->reqData['fields'] = implode(',', array_keys($this->fields));
    }

    /**
     * @param array $numIidList
     * @throws \SyException\Promotion\TBKException
     */
    public function setNumIidList(array $numIidList)
    {
        $this->num_iids = [];
        foreach ($numIidList as $eNumIid) {
            $trueId = is_int($eNumIid) ? $eNumIid : 0;
            if ($trueId > 0) {
                $this->num_iids[$trueId] = 1;
            }
        }

        $needNum = count($this->num_iids);
        if ($needNum == 0) {
            throw new TBKException('商品ID列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        } elseif ($needNum > 40) {
            throw new TBKException('商品ID列表不能超过40个', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $this->reqData['num_iids'] = implode(',', array_keys($this->num_iids));
    }

    /**
     * @param int $adZoneId
     * @throws \SyException\Promotion\TBKException
     */
    public function setAdZoneId(int $adZoneId)
    {
        if ($adZoneId > 0) {
            $this->reqData['adzone_id'] = $adZoneId;
        } else {
            throw new TBKException('广告位ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @param int $platform
     * @throws \SyException\Promotion\TBKException
     */
    public function setPlatform(int $platform)
    {
        if (in_array($platform, [1, 2])) {
            $this->reqData['platform'] = $platform;
        } else {
            throw new TBKException('链接形式不支持', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @param string $unid
     * @throws \SyException\Promotion\TBKException
     */
    public function setUnid(string $unid)
    {
        if (ctype_alnum($unid) && (strlen($unid) <= 12)) {
            $this->reqData['unid'] = $unid;
        } else {
            throw new TBKException('推广渠道不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @param string $dx
     */
    public function setDx(string $dx)
    {
        $this->reqData['dx'] = trim($dx);
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['fields'])) {
            throw new TBKException('返回字段列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['num_iids'])) {
            throw new TBKException('商品ID列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['adzone_id'])) {
            throw new TBKException('广告位ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
