<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getBizdate()
 * @method string getInGroupId()
 * @method string getBaselineId()
 */
class GetBaselineKeyPath extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizdate($value)
    {
        $this->data['Bizdate'] = $value;
        $this->options['form_params']['Bizdate'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInGroupId($value)
    {
        $this->data['InGroupId'] = $value;
        $this->options['form_params']['InGroupId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBaselineId($value)
    {
        $this->data['BaselineId'] = $value;
        $this->options['form_params']['BaselineId'] = $value;

        return $this;
    }
}
