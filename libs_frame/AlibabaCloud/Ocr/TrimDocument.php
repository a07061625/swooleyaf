<?php

namespace AlibabaCloud\Ocr;

/**
 * @method string getFileType()
 * @method string getAsync()
 * @method string getFileURL()
 * @method string getOutputType()
 */
class TrimDocument extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFileType($value)
    {
        $this->data['FileType'] = $value;
        $this->options['form_params']['FileType'] = $value;

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
    public function withFileURL($value)
    {
        $this->data['FileURL'] = $value;
        $this->options['form_params']['FileURL'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOutputType($value)
    {
        $this->data['OutputType'] = $value;
        $this->options['form_params']['OutputType'] = $value;

        return $this;
    }
}
