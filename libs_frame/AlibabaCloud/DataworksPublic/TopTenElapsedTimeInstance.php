<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getBusinessDate()
 * @method string getProjectId()
 */
class TopTenElapsedTimeInstance extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBusinessDate($value)
    {
        $this->data['BusinessDate'] = $value;
        $this->options['form_params']['BusinessDate'] = $value;

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
}
