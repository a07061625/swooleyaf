<?php

namespace AlibabaCloud\Ocr;

/**
 * @method string getFileURL()
 */
class RecognizePDF extends Rpc
{
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
}
