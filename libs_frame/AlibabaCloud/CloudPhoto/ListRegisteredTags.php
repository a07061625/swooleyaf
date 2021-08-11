<?php

namespace AlibabaCloud\CloudPhoto;

/**
 * @method string getStoreName()
 * @method $this withStoreName($value)
 * @method array getLang()
 */
class ListRegisteredTags extends Rpc
{
    /**
     * @return $this
     */
    public function withLang(array $lang)
    {
        $this->data['Lang'] = $lang;
        foreach ($lang as $i => $iValue) {
            $this->options['query']['Lang.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
