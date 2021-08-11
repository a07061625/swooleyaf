<?php

namespace AlibabaCloud\Ocr;

/**
 * @method string getFileType()
 * @method string getFileURL()
 */
class RecognizeVATInvoice extends Rpc
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
    public function withFileURL($value)
    {
        $this->data['FileURL'] = $value;
        $this->options['form_params']['FileURL'] = $value;

        return $this;
    }
}
