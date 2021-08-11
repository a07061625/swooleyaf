<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method array getNodeTuples()
 */
class SubmitExternalNodeTuplesImportingTask extends Rpc
{
    /**
     * @return $this
     */
    public function withNodeTuples(array $nodeTuples)
    {
        $this->data['NodeTuples'] = $nodeTuples;
        foreach ($nodeTuples as $depth1 => $depth1Value) {
            $this->options['form_params']['NodeTuples.' . ($depth1 + 1) . '.AppSKey'] = $depth1Value['AppSKey'];
            $this->options['form_params']['NodeTuples.' . ($depth1 + 1) . '.NwkSKey'] = $depth1Value['NwkSKey'];
            $this->options['form_params']['NodeTuples.' . ($depth1 + 1) . '.LoraVer'] = $depth1Value['LoraVer'];
            $this->options['form_params']['NodeTuples.' . ($depth1 + 1) . '.DevEui'] = $depth1Value['DevEui'];
        }

        return $this;
    }
}
