<?php

namespace AlibabaCloud\Reid;

/**
 * @method string getStoreId()
 * @method string getEndMessageId()
 * @method string getLimit()
 * @method string getStartMessageId()
 */
class PullActionData extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStoreId($value)
    {
        $this->data['StoreId'] = $value;
        $this->options['form_params']['StoreId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndMessageId($value)
    {
        $this->data['EndMessageId'] = $value;
        $this->options['form_params']['EndMessageId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLimit($value)
    {
        $this->data['Limit'] = $value;
        $this->options['form_params']['Limit'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStartMessageId($value)
    {
        $this->data['StartMessageId'] = $value;
        $this->options['form_params']['StartMessageId'] = $value;

        return $this;
    }
}
