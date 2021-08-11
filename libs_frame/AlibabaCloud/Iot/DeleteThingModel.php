<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getRealTenantId()
 * @method $this withRealTenantId($value)
 * @method string getIsClearAllFunction()
 * @method $this withIsClearAllFunction($value)
 * @method string getRealTripartiteKey()
 * @method $this withRealTripartiteKey($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method array getPropertyIdentifier()
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method array getServiceIdentifier()
 * @method string getProductKey()
 * @method $this withProductKey($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method array getEventIdentifier()
 * @method string getFunctionBlockId()
 * @method $this withFunctionBlockId($value)
 */
class DeleteThingModel extends Rpc
{
    /**
     * @return $this
     */
    public function withPropertyIdentifier(array $propertyIdentifier)
    {
        $this->data['PropertyIdentifier'] = $propertyIdentifier;
        foreach ($propertyIdentifier as $i => $iValue) {
            $this->options['query']['PropertyIdentifier.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withServiceIdentifier(array $serviceIdentifier)
    {
        $this->data['ServiceIdentifier'] = $serviceIdentifier;
        foreach ($serviceIdentifier as $i => $iValue) {
            $this->options['query']['ServiceIdentifier.' . ($i + 1)] = $iValue;
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

    /**
     * @return $this
     */
    public function withEventIdentifier(array $eventIdentifier)
    {
        $this->data['EventIdentifier'] = $eventIdentifier;
        foreach ($eventIdentifier as $i => $iValue) {
            $this->options['query']['EventIdentifier.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
