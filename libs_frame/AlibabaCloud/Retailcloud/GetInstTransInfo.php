<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getAliyunUid()
 * @method string getAliyunEquipId()
 * @method string getAliyunCommodityCode()
 */
class GetInstTransInfo extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAliyunUid($value)
    {
        $this->data['AliyunUid'] = $value;
        $this->options['form_params']['aliyunUid'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAliyunEquipId($value)
    {
        $this->data['AliyunEquipId'] = $value;
        $this->options['form_params']['aliyunEquipId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAliyunCommodityCode($value)
    {
        $this->data['AliyunCommodityCode'] = $value;
        $this->options['form_params']['aliyunCommodityCode'] = $value;

        return $this;
    }
}
