<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getMaxMessageCount()
 * @method string getPreferredMaxBytes()
 * @method array getOrganization()
 * @method string getBatchTimeout()
 * @method string getChannelName()
 * @method $this withChannelName($value)
 * @method string getConsortiumId()
 * @method $this withConsortiumId($value)
 */
class CreateChannel extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMaxMessageCount($value)
    {
        $this->data['MaxMessageCount'] = $value;
        $this->options['form_params']['MaxMessageCount'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPreferredMaxBytes($value)
    {
        $this->data['PreferredMaxBytes'] = $value;
        $this->options['form_params']['PreferredMaxBytes'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withOrganization(array $organization)
    {
        $this->data['Organization'] = $organization;
        foreach ($organization as $depth1 => $depth1Value) {
            $this->options['query']['Organization.' . ($depth1 + 1) . '.Id'] = $depth1Value['Id'];
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBatchTimeout($value)
    {
        $this->data['BatchTimeout'] = $value;
        $this->options['form_params']['BatchTimeout'] = $value;

        return $this;
    }
}
