<?php

namespace AlibabaCloud\Imageenhan;

/**
 * @method array getColorTemplate()
 * @method string getDegree()
 * @method string getUrl()
 * @method string getMode()
 * @method string getAsync()
 * @method string getColorCount()
 * @method string getRefUrl()
 */
class RecolorHDImage extends Rpc
{
    /**
     * @return $this
     */
    public function withColorTemplate(array $colorTemplate)
    {
        $this->data['ColorTemplate'] = $colorTemplate;
        foreach ($colorTemplate as $depth1 => $depth1Value) {
            if (isset($depth1Value['Color'])) {
                $this->options['form_params']['ColorTemplate.' . ($depth1 + 1) . '.Color'] = $depth1Value['Color'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDegree($value)
    {
        $this->data['Degree'] = $value;
        $this->options['form_params']['Degree'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUrl($value)
    {
        $this->data['Url'] = $value;
        $this->options['form_params']['Url'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMode($value)
    {
        $this->data['Mode'] = $value;
        $this->options['form_params']['Mode'] = $value;

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
    public function withColorCount($value)
    {
        $this->data['ColorCount'] = $value;
        $this->options['form_params']['ColorCount'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRefUrl($value)
    {
        $this->data['RefUrl'] = $value;
        $this->options['form_params']['RefUrl'] = $value;

        return $this;
    }
}
