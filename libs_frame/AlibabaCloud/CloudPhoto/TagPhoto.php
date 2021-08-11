<?php

namespace AlibabaCloud\CloudPhoto;

/**
 * @method string getLibraryId()
 * @method $this withLibraryId($value)
 * @method array getConfidence()
 * @method string getStoreName()
 * @method $this withStoreName($value)
 * @method string getPhotoId()
 * @method $this withPhotoId($value)
 * @method array getTagKey()
 */
class TagPhoto extends Rpc
{
    /**
     * @return $this
     */
    public function withConfidence(array $confidence)
    {
        $this->data['Confidence'] = $confidence;
        foreach ($confidence as $i => $iValue) {
            $this->options['query']['Confidence.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withTagKey(array $tagKey)
    {
        $this->data['TagKey'] = $tagKey;
        foreach ($tagKey as $i => $iValue) {
            $this->options['query']['TagKey.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
