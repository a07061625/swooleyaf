<?php

namespace AlibabaCloud\Lubancloud;

/**
 * @method array getPictureUrl()
 */
class SubmitCutoutTask extends Rpc
{
    /**
     * @return $this
     */
    public function withPictureUrl(array $pictureUrl)
    {
        $this->data['PictureUrl'] = $pictureUrl;
        foreach ($pictureUrl as $i => $iValue) {
            $this->options['query']['PictureUrl.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
