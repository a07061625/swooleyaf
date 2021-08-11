<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getCheckDetailUrl()
 * @method string getCheckerInstanceId()
 * @method string getStatus()
 */
class CheckFileDeployment extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCheckDetailUrl($value)
    {
        $this->data['CheckDetailUrl'] = $value;
        $this->options['form_params']['CheckDetailUrl'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCheckerInstanceId($value)
    {
        $this->data['CheckerInstanceId'] = $value;
        $this->options['form_params']['CheckerInstanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStatus($value)
    {
        $this->data['Status'] = $value;
        $this->options['form_params']['Status'] = $value;

        return $this;
    }
}
