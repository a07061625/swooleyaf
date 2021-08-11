<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getIsvSubId()
 * @method string getCorpId()
 * @method string getCatalogId()
 */
class DeleteProfileCatalog extends Rpc
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
    public function withCatalogId($value)
    {
        $this->data['CatalogId'] = $value;
        $this->options['form_params']['CatalogId'] = $value;

        return $this;
    }
}
