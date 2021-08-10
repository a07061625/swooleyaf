<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getNodeType()
 * @method $this withNodeType($value)
 * @method string getRealTenantId()
 * @method $this withRealTenantId($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getCategoryKey()
 * @method $this withCategoryKey($value)
 * @method string getJoinPermissionId()
 * @method $this withJoinPermissionId($value)
 * @method string getAuthType()
 * @method $this withAuthType($value)
 * @method string getRealTripartiteKey()
 * @method $this withRealTripartiteKey($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getValidateType()
 * @method $this withValidateType($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getProductName()
 * @method $this withProductName($value)
 * @method string getAliyunCommodityCode()
 * @method $this withAliyunCommodityCode($value)
 * @method string getPublishAuto()
 * @method $this withPublishAuto($value)
 * @method string getCategoryId()
 * @method $this withCategoryId($value)
 * @method string getDataFormat()
 * @method $this withDataFormat($value)
 * @method string getId2()
 * @method $this withId2($value)
 * @method string getNetType()
 * @method $this withNetType($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method string getProtocolType()
 * @method $this withProtocolType($value)
 */
class CreateProduct extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiProduct($value)
    {
        $this->data['ApiProduct'] = $value;
        $this->options['form_params']['ApiProduct'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiRevision($value)
    {
        $this->data['ApiRevision'] = $value;
        $this->options['form_params']['ApiRevision'] = $value;

        return $this;
    }
}
