<?php

namespace AlibabaCloud\Cloudesl;

/**
 * @method string getExtraParams()
 * @method string getStoreName()
 * @method string getStoreId()
 * @method string getTemplateVersion()
 * @method string getUserStoreCode()
 * @method string getPhone()
 */
class UpdateStore extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExtraParams($value)
    {
        $this->data['ExtraParams'] = $value;
        $this->options['form_params']['ExtraParams'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStoreName($value)
    {
        $this->data['StoreName'] = $value;
        $this->options['form_params']['StoreName'] = $value;

        return $this;
    }

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
    public function withTemplateVersion($value)
    {
        $this->data['TemplateVersion'] = $value;
        $this->options['form_params']['TemplateVersion'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserStoreCode($value)
    {
        $this->data['UserStoreCode'] = $value;
        $this->options['form_params']['UserStoreCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPhone($value)
    {
        $this->data['Phone'] = $value;
        $this->options['form_params']['Phone'] = $value;

        return $this;
    }
}
