<?php

namespace AlibabaCloud\Imgsearch;

/**
 * @method string getEntityId()
 * @method string getDbName()
 * @method string getImageUrl()
 * @method string getExtraData()
 */
class AddImage extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEntityId($value)
    {
        $this->data['EntityId'] = $value;
        $this->options['form_params']['EntityId'] = $value;

        return $this;
    }

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
    public function withImageUrl($value)
    {
        $this->data['ImageUrl'] = $value;
        $this->options['form_params']['ImageUrl'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExtraData($value)
    {
        $this->data['ExtraData'] = $value;
        $this->options['form_params']['ExtraData'] = $value;

        return $this;
    }
}
