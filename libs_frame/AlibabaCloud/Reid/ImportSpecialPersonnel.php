<?php

namespace AlibabaCloud\Reid;

/**
 * @method string getUkId()
 * @method string getDescription()
 * @method string getExternalId()
 * @method string getPersonType()
 * @method string getUrls()
 * @method string getPersonName()
 * @method string getStoreIds()
 * @method string getStatus()
 */
class ImportSpecialPersonnel extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUkId($value)
    {
        $this->data['UkId'] = $value;
        $this->options['form_params']['UkId'] = $value;

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
    public function withExternalId($value)
    {
        $this->data['ExternalId'] = $value;
        $this->options['form_params']['ExternalId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPersonType($value)
    {
        $this->data['PersonType'] = $value;
        $this->options['form_params']['PersonType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUrls($value)
    {
        $this->data['Urls'] = $value;
        $this->options['form_params']['Urls'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPersonName($value)
    {
        $this->data['PersonName'] = $value;
        $this->options['form_params']['PersonName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStoreIds($value)
    {
        $this->data['StoreIds'] = $value;
        $this->options['form_params']['StoreIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStatus($value)
    {
        $this->data['Status'] = $value;
        $this->options['form_params']['Status'] = $value;

        return $this;
    }
}
