<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getAlgorithmType()
 * @method string getCorpId()
 * @method string getAttributeName()
 * @method string getOperatorType()
 * @method string getValue()
 */
class DeleteRecords extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAlgorithmType($value)
    {
        $this->data['AlgorithmType'] = $value;
        $this->options['form_params']['AlgorithmType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCorpId($value)
    {
        $this->data['CorpId'] = $value;
        $this->options['form_params']['CorpId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAttributeName($value)
    {
        $this->data['AttributeName'] = $value;
        $this->options['form_params']['AttributeName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOperatorType($value)
    {
        $this->data['OperatorType'] = $value;
        $this->options['form_params']['OperatorType'] = $value;

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
