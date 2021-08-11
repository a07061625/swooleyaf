<?php

namespace AlibabaCloud\Alinlp;

/**
 * @method string getServiceCode()
 * @method string getOriginT()
 * @method string getOriginQ()
 */
class GetCheckDuplicationChMedical extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withServiceCode($value)
    {
        $this->data['ServiceCode'] = $value;
        $this->options['form_params']['ServiceCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOriginT($value)
    {
        $this->data['OriginT'] = $value;
        $this->options['form_params']['OriginT'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOriginQ($value)
    {
        $this->data['OriginQ'] = $value;
        $this->options['form_params']['OriginQ'] = $value;

        return $this;
    }
}
