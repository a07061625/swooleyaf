<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getInstanceId()
 * @method string getEntityType()
 * @method string getEntityId()
 */
class GetTagList extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId($value)
    {
        $this->data['InstanceId'] = $value;
        $this->options['form_params']['InstanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEntityType($value)
    {
        $this->data['EntityType'] = $value;
        $this->options['form_params']['EntityType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEntityId($value)
    {
        $this->data['EntityId'] = $value;
        $this->options['form_params']['EntityId'] = $value;

        return $this;
    }
}
