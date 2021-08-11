<?php

namespace AlibabaCloud\Videoenhan;

/**
 * @method string getPostURL()
 * @method string getReferenceURL()
 * @method string getAsync()
 * @method string getVideoURL()
 */
class MergeVideoFace extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPostURL($value)
    {
        $this->data['PostURL'] = $value;
        $this->options['form_params']['PostURL'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withReferenceURL($value)
    {
        $this->data['ReferenceURL'] = $value;
        $this->options['form_params']['ReferenceURL'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAsync($value)
    {
        $this->data['Async'] = $value;
        $this->options['form_params']['Async'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVideoURL($value)
    {
        $this->data['VideoURL'] = $value;
        $this->options['form_params']['VideoURL'] = $value;

        return $this;
    }
}
