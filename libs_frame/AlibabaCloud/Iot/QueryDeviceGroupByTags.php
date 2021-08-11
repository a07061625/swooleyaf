<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method array getTag()
 * @method string getCurrentPage()
 * @method $this withCurrentPage($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 */
class QueryDeviceGroupByTags extends Rpc
{
    /**
     * @return $this
     */
    public function withTag(array $tag)
    {
        $this->data['Tag'] = $tag;
        foreach ($tag as $depth1 => $depth1Value) {
            if (isset($depth1Value['TagValue'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.TagValue'] = $depth1Value['TagValue'];
            }
            if (isset($depth1Value['TagKey'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.TagKey'] = $depth1Value['TagKey'];
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
