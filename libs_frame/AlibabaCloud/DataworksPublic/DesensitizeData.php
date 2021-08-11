<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getSceneCode()
 * @method string getData()
 */
class DesensitizeData extends Rpc
{
    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSceneCode($value)
    {
        $this->data['SceneCode'] = $value;
        $this->options['form_params']['SceneCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withData($value)
    {
        $this->data['Data'] = $value;
        $this->options['form_params']['Data'] = $value;

        return $this;
    }
}
