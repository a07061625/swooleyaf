<?php

namespace AlibabaCloud\ARMS;

/**
 * @method array getTraceIDs()
 */
class GetMultipleTrace extends Rpc
{
    /**
     * @return $this
     */
    public function withTraceIDs(array $traceIDs)
    {
        $this->data['TraceIDs'] = $traceIDs;
        foreach ($traceIDs as $i => $iValue) {
            $this->options['query']['TraceIDs.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
