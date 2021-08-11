<?php

namespace AlibabaCloud\Cms;

/**
 * @method array getEventInfo()
 */
class PutCustomEvent extends Rpc
{
    /**
     * @return $this
     */
    public function withEventInfo(array $eventInfo)
    {
        $this->data['EventInfo'] = $eventInfo;
        foreach ($eventInfo as $depth1 => $depth1Value) {
            if (isset($depth1Value['GroupId'])) {
                $this->options['query']['EventInfo.' . ($depth1 + 1) . '.GroupId'] = $depth1Value['GroupId'];
            }
            if (isset($depth1Value['Time'])) {
                $this->options['query']['EventInfo.' . ($depth1 + 1) . '.Time'] = $depth1Value['Time'];
            }
            if (isset($depth1Value['EventName'])) {
                $this->options['query']['EventInfo.' . ($depth1 + 1) . '.EventName'] = $depth1Value['EventName'];
            }
            if (isset($depth1Value['Content'])) {
                $this->options['query']['EventInfo.' . ($depth1 + 1) . '.Content'] = $depth1Value['Content'];
            }
        }

        return $this;
    }
}
