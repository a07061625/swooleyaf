<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getDbName()
 * @method string getDbInstanceId()
 * @method string getDbDescription()
 * @method string getCharacterSetName()
 */
class CreateDb extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDbName($value)
    {
        $this->data['DbName'] = $value;
        $this->options['form_params']['DbName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDbInstanceId($value)
    {
        $this->data['DbInstanceId'] = $value;
        $this->options['form_params']['DbInstanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDbDescription($value)
    {
        $this->data['DbDescription'] = $value;
        $this->options['form_params']['DbDescription'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCharacterSetName($value)
    {
        $this->data['CharacterSetName'] = $value;
        $this->options['form_params']['CharacterSetName'] = $value;

        return $this;
    }
}
