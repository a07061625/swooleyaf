<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getEndMillis()
 * @method string getBeginMillis()
 * @method string getNodeGroupId()
 * @method string getTimeIntervalUnit()
 */
class ListNodeGroupTransferFlowStats extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndMillis($value)
    {
        $this->data['EndMillis'] = $value;
        $this->options['form_params']['EndMillis'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBeginMillis($value)
    {
        $this->data['BeginMillis'] = $value;
        $this->options['form_params']['BeginMillis'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNodeGroupId($value)
    {
        $this->data['NodeGroupId'] = $value;
        $this->options['form_params']['NodeGroupId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTimeIntervalUnit($value)
    {
        $this->data['TimeIntervalUnit'] = $value;
        $this->options['form_params']['TimeIntervalUnit'] = $value;

        return $this;
    }
}
