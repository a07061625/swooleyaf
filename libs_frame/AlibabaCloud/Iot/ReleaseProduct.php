<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getTemplate()
 * @method $this withTemplate($value)
 * @method string getCategoryKey()
 * @method $this withCategoryKey($value)
 * @method string getTemplateIdentifier()
 * @method $this withTemplateIdentifier($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getTemplateName()
 * @method $this withTemplateName($value)
 * @method string getProductKey()
 * @method $this withProductKey($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method string getCategoryName()
 * @method $this withCategoryName($value)
 * @method string getBizTenantId()
 * @method $this withBizTenantId($value)
 */
class ReleaseProduct extends Rpc
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
