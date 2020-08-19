<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 10:54
 */
namespace SyPay\Union\Channels\Traits;

/**
 * Trait SubMerInfo
 *
 * @package SyPay\Union\Channels\Traits
 */
trait SubMerInfoTrait
{
    /**
     * @param string $subMerId 二级商户代码
     */
    public function setSubMerId(string $subMerId)
    {
        if (strlen($subMerId) > 0) {
            $this->reqData['subMerId'] = $subMerId;
        }
    }

    /**
     * @param string $subMerAbbr 二级商户简称
     */
    public function setSubMerAbbr(string $subMerAbbr)
    {
        if (strlen($subMerAbbr) > 0) {
            $this->reqData['subMerAbbr'] = $subMerAbbr;
        }
    }

    /**
     * @param string $subMerName 二级商户名称
     */
    public function setSubMerName(string $subMerName)
    {
        if (strlen($subMerName)) {
            $this->reqData['subMerName'] = $subMerName;
        }
    }
}
