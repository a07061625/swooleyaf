<?php

namespace AlibabaCloud\CDRS;

/**
 * @method string getCorpId()
 * @method string getIcon()
 * @method string getDescription()
 * @method string getAppName()
 * @method string getNameSpace()
 * @method string getName()
 * @method string getAggregateSceneCode()
 */
class UpdateProject extends Rpc
{
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
    public function withIcon($value)
    {
        $this->data['Icon'] = $value;
        $this->options['form_params']['Icon'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDescription($value)
    {
        $this->data['Description'] = $value;
        $this->options['form_params']['Description'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppName($value)
    {
        $this->data['AppName'] = $value;
        $this->options['form_params']['AppName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNameSpace($value)
    {
        $this->data['NameSpace'] = $value;
        $this->options['form_params']['NameSpace'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withName($value)
    {
        $this->data['Name'] = $value;
        $this->options['form_params']['Name'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAggregateSceneCode($value)
    {
        $this->data['AggregateSceneCode'] = $value;
        $this->options['form_params']['AggregateSceneCode'] = $value;

        return $this;
    }
}
