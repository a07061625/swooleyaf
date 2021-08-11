<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getSpec()
 * @method $this withSpec($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getTags()
 * @method $this withTags($value)
 * @method string getApiProduct()
 * @method string getName()
 * @method $this withName($value)
 * @method string getApiRevision()
 */
class CreateEdgeInstance extends Rpc
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
