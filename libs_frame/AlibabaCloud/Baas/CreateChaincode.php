<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getOrganizationId()
 * @method string getOssBucket()
 * @method string getOssUrl()
 * @method string getEndorsePolicy()
 * @method string getLocation()
 * @method string getChannelId()
 * @method string getConsortiumId()
 */
class CreateChaincode extends Rpc
{
    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrganizationId($value)
    {
        $this->data['OrganizationId'] = $value;
        $this->options['form_params']['OrganizationId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOssBucket($value)
    {
        $this->data['OssBucket'] = $value;
        $this->options['form_params']['OssBucket'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOssUrl($value)
    {
        $this->data['OssUrl'] = $value;
        $this->options['form_params']['OssUrl'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndorsePolicy($value)
    {
        $this->data['EndorsePolicy'] = $value;
        $this->options['form_params']['EndorsePolicy'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLocation($value)
    {
        $this->data['Location'] = $value;
        $this->options['form_params']['Location'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withChannelId($value)
    {
        $this->data['ChannelId'] = $value;
        $this->options['form_params']['ChannelId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withConsortiumId($value)
    {
        $this->data['ConsortiumId'] = $value;
        $this->options['form_params']['ConsortiumId'] = $value;

        return $this;
    }
}
