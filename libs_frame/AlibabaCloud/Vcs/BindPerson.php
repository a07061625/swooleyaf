<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getIsvSubId()
 * @method string getCorpId()
 * @method string getPersonMatchingRate()
 * @method string getProfileId()
 * @method string getPersonId()
 */
class BindPerson extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIsvSubId($value)
    {
        $this->data['IsvSubId'] = $value;
        $this->options['form_params']['IsvSubId'] = $value;

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
    public function withPersonMatchingRate($value)
    {
        $this->data['PersonMatchingRate'] = $value;
        $this->options['form_params']['PersonMatchingRate'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProfileId($value)
    {
        $this->data['ProfileId'] = $value;
        $this->options['form_params']['ProfileId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPersonId($value)
    {
        $this->data['PersonId'] = $value;
        $this->options['form_params']['PersonId'] = $value;

        return $this;
    }
}
