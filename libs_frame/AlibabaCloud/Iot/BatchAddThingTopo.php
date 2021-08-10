<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getGwProductKey()
 * @method $this withGwProductKey($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getExt()
 * @method $this withExt($value)
 * @method array getTopoAddItem()
 * @method string getGwDeviceName()
 * @method $this withGwDeviceName($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 */
class BatchAddThingTopo extends Rpc
{
    /**
     * @return $this
     */
    public function withTopoAddItem(array $topoAddItem)
    {
        $this->data['TopoAddItem'] = $topoAddItem;
        foreach ($topoAddItem as $depth1 => $depth1Value) {
            if (isset($depth1Value['ClientId'])) {
                $this->options['query']['TopoAddItem.' . ($depth1 + 1) . '.ClientId'] = $depth1Value['ClientId'];
            }
            if (isset($depth1Value['SignMethod'])) {
                $this->options['query']['TopoAddItem.' . ($depth1 + 1) . '.SignMethod'] = $depth1Value['SignMethod'];
            }
            if (isset($depth1Value['Sign'])) {
                $this->options['query']['TopoAddItem.' . ($depth1 + 1) . '.Sign'] = $depth1Value['Sign'];
            }
            if (isset($depth1Value['DeviceName'])) {
                $this->options['query']['TopoAddItem.' . ($depth1 + 1) . '.DeviceName'] = $depth1Value['DeviceName'];
            }
            if (isset($depth1Value['ProductKey'])) {
                $this->options['query']['TopoAddItem.' . ($depth1 + 1) . '.ProductKey'] = $depth1Value['ProductKey'];
            }
            if (isset($depth1Value['Timestamp'])) {
                $this->options['query']['TopoAddItem.' . ($depth1 + 1) . '.Timestamp'] = $depth1Value['Timestamp'];
            }
        }

        return $this;
    }

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
}
