<?php

namespace AlibabaCloud\Imageenhan;

/**
 * @method string getBH()
 * @method string getBW()
 * @method string getBX()
 * @method string getImageURL()
 * @method string getBY()
 */
class RemoveImageSubtitles extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBH($value)
    {
        $this->data['BH'] = $value;
        $this->options['form_params']['BH'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBW($value)
    {
        $this->data['BW'] = $value;
        $this->options['form_params']['BW'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBX($value)
    {
        $this->data['BX'] = $value;
        $this->options['form_params']['BX'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImageURL($value)
    {
        $this->data['ImageURL'] = $value;
        $this->options['form_params']['ImageURL'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBY($value)
    {
        $this->data['BY'] = $value;
        $this->options['form_params']['BY'] = $value;

        return $this;
    }
}
