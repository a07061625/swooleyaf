<?php

namespace AlibabaCloud\EHPC;

/**
 * @method array getDesktopId()
 */
class EcdDeleteDesktops extends Rpc
{
    /**
     * @return $this
     */
    public function withDesktopId(array $desktopId)
    {
        $this->data['DesktopId'] = $desktopId;
        foreach ($desktopId as $i => $iValue) {
            $this->options['query']['DesktopId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
