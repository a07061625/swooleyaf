<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getDriverId()
 * @method $this withDriverId($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method array getChannelIds()
 */
class BatchDeleteEdgeInstanceChannel extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiProduct($value)
    {
        $this->data['ApiProduct'] = $value;
        $this->options['form_params']['ApiProduct'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiRevision($value)
    {
        $this->data['ApiRevision'] = $value;
        $this->options['form_params']['ApiRevision'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withChannelIds(array $channelIds)
    {
        $this->data['ChannelIds'] = $channelIds;
        foreach ($channelIds as $i => $iValue) {
            $this->options['query']['ChannelIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
