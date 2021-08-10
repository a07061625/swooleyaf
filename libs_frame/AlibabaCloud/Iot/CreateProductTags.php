<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getRealTenantId()
 * @method $this withRealTenantId($value)
 * @method string getRealTripartiteKey()
 * @method $this withRealTripartiteKey($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getProductKey()
 * @method $this withProductKey($value)
 * @method array getProductTag()
 * @method string getApiProduct()
 * @method string getApiRevision()
 */
class CreateProductTags extends Rpc
{
    /**
     * @return $this
     */
    public function withProductTag(array $productTag)
    {
        $this->data['ProductTag'] = $productTag;
        foreach ($productTag as $depth1 => $depth1Value) {
            if (isset($depth1Value['TagValue'])) {
                $this->options['query']['ProductTag.' . ($depth1 + 1) . '.TagValue'] = $depth1Value['TagValue'];
            }
            if (isset($depth1Value['TagKey'])) {
                $this->options['query']['ProductTag.' . ($depth1 + 1) . '.TagKey'] = $depth1Value['TagKey'];
            }
        }

        return $this;
    }

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
