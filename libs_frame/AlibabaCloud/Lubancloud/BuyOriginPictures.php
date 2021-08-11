<?php

namespace AlibabaCloud\Lubancloud;

/**
 * @method array getPictureId()
 */
class BuyOriginPictures extends Rpc
{
    /**
     * @return $this
     */
    public function withPictureId(array $pictureId)
    {
        $this->data['PictureId'] = $pictureId;
        foreach ($pictureId as $i => $iValue) {
            $this->options['query']['PictureId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
