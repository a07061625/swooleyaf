<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getInstanceId()
 * @method string getEntityTagParam()
 */
class UpdateEntityTagRelation extends Rpc
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
    public function withEntityTagParam($value)
    {
        $this->data['EntityTagParam'] = $value;
        $this->options['form_params']['EntityTagParam'] = $value;

        return $this;
    }
}
