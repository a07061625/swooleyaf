<?php

namespace AlibabaCloud\CloudPhoto;

/**
 * @method string getLibraryId()
 * @method $this withLibraryId($value)
 * @method string getTargetFaceId()
 * @method $this withTargetFaceId($value)
 * @method string getStoreName()
 * @method $this withStoreName($value)
 * @method array getFaceId()
 */
class MergeFaces extends Rpc
{
    /**
     * @return $this
     */
    public function withFaceId(array $faceId)
    {
        $this->data['FaceId'] = $faceId;
        foreach ($faceId as $i => $iValue) {
            $this->options['query']['FaceId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
