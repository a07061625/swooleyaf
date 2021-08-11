<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getAlgorithmType()
 * @method string getCorpId()
 * @method string getPersonID()
 */
class GetPersonDetail extends Rpc
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
    public function withPersonID($value)
    {
        $this->data['PersonID'] = $value;
        $this->options['form_params']['PersonID'] = $value;

        return $this;
    }
}
