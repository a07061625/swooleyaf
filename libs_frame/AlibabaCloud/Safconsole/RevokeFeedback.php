<?php

namespace AlibabaCloud\Safconsole;

/**
 * @method string getSampleType()
 * @method string getValue()
 */
class RevokeFeedback extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSampleType($value)
    {
        $this->data['SampleType'] = $value;
        $this->options['form_params']['SampleType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withValue($value)
    {
        $this->data['Value'] = $value;
        $this->options['form_params']['Value'] = $value;

        return $this;
    }
}
