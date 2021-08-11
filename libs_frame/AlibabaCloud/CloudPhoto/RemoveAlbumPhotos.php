<?php

namespace AlibabaCloud\CloudPhoto;

/**
 * @method string getLibraryId()
 * @method $this withLibraryId($value)
 * @method string getAlbumId()
 * @method $this withAlbumId($value)
 * @method array getPhotoId()
 * @method string getStoreName()
 * @method $this withStoreName($value)
 */
class RemoveAlbumPhotos extends Rpc
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
