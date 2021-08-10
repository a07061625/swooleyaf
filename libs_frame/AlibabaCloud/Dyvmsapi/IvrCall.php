<?php

namespace AlibabaCloud\Dyvmsapi;

/**
 * @method string getByeCode()
 * @method $this withByeCode($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getStartTtsParams()
 * @method $this withStartTtsParams($value)
 * @method string getTimeout()
 * @method $this withTimeout($value)
 * @method string getStartCode()
 * @method $this withStartCode($value)
 * @method string getCalledNumber()
 * @method $this withCalledNumber($value)
 * @method string getCalledShowNumber()
 * @method $this withCalledShowNumber($value)
 * @method array getMenuKeyMap()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getPlayTimes()
 * @method $this withPlayTimes($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getOutId()
 * @method $this withOutId($value)
 * @method string getByeTtsParams()
 * @method $this withByeTtsParams($value)
 */
class IvrCall extends Rpc
{
    /**
     * @return $this
     */
    public function withMenuKeyMap(array $menuKeyMap)
    {
        $this->data['MenuKeyMap'] = $menuKeyMap;
        foreach ($menuKeyMap as $depth1 => $depth1Value) {
            if (isset($depth1Value['Code'])) {
                $this->options['query']['MenuKeyMap.' . ($depth1 + 1) . '.Code'] = $depth1Value['Code'];
            }
            if (isset($depth1Value['TtsParams'])) {
                $this->options['query']['MenuKeyMap.' . ($depth1 + 1) . '.TtsParams'] = $depth1Value['TtsParams'];
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['MenuKeyMap.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
        }

        return $this;
    }
}
