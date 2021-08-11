<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getIsvSubId()
 * @method string getParentCatalogId()
 * @method string getCorpId()
 * @method string getCatalogName()
 */
class AddProfileCatalog extends Rpc
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
    public function withParentCatalogId($value)
    {
        $this->data['ParentCatalogId'] = $value;
        $this->options['form_params']['ParentCatalogId'] = $value;

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
    public function withCatalogName($value)
    {
        $this->data['CatalogName'] = $value;
        $this->options['form_params']['CatalogName'] = $value;

        return $this;
    }
}
