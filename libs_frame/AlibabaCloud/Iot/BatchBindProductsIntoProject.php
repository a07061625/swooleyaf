<?php

namespace AlibabaCloud\Iot;

/**
 * @method array getProductKeys()
 * @method string getIotInstanceId()
 * @method string getProjectId()
 * @method string getApiProduct()
 * @method string getApiRevision()
 */
class BatchBindProductsIntoProject extends Rpc
{
    /**
     * @return $this
     */
    public function withProductKeys(array $productKeys)
    {
        $this->data['ProductKeys'] = $productKeys;
        foreach ($productKeys as $i => $iValue) {
            $this->options['form_params']['ProductKeys.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIotInstanceId($value)
    {
        $this->data['IotInstanceId'] = $value;
        $this->options['form_params']['IotInstanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectId($value)
    {
        $this->data['ProjectId'] = $value;
        $this->options['form_params']['ProjectId'] = $value;

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
