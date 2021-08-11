<?php

namespace AlibabaCloud\CloudPhoto;

/**
 * @method string getTakenAt()
 * @method $this withTakenAt($value)
 * @method string getLibraryId()
 * @method $this withLibraryId($value)
 * @method string getShareExpireTime()
 * @method $this withShareExpireTime($value)
 * @method array getPhotoId()
 * @method string getStoreName()
 * @method $this withStoreName($value)
 * @method string getRemark()
 * @method $this withRemark($value)
 * @method string getTitle()
 * @method $this withTitle($value)
 */
class EditPhotos extends Rpc
{
    /**
     * @return $this
     */
    public function withPhotoId(array $photoId)
    {
        $this->data['PhotoId'] = $photoId;
        foreach ($photoId as $i => $iValue) {
            $this->options['query']['PhotoId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
