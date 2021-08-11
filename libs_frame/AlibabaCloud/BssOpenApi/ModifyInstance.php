<?php

namespace AlibabaCloud\BssOpenApi;

/**
 * @method string getProductCode()
 * @method $this withProductCode($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getSubscriptionType()
 * @method $this withSubscriptionType($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getProductType()
 * @method $this withProductType($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getModifyType()
 * @method $this withModifyType($value)
 * @method array getParameter()
 */
class ModifyInstance extends Rpc
{
    /**
     * @return $this
     */
    public function withParameter(array $parameter)
    {
        $this->data['Parameter'] = $parameter;
        foreach ($parameter as $depth1 => $depth1Value) {
            if (isset($depth1Value['Code'])) {
                $this->options['query']['Parameter.' . ($depth1 + 1) . '.Code'] = $depth1Value['Code'];
            }
            if (isset($depth1Value['Value'])) {
                $this->options['query']['Parameter.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
        }

        return $this;
    }
}
