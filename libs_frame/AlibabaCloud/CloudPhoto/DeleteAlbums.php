<?php

namespace AlibabaCloud\CloudPhoto;

/**
 * @method string getLibraryId()
 * @method $this withLibraryId($value)
 * @method array getAlbumId()
 * @method string getStoreName()
 * @method $this withStoreName($value)
 */
class DeleteAlbums extends Rpc
{
    /**
     * @return $this
     */
    public function withAlbumId(array $albumId)
    {
        $this->data['AlbumId'] = $albumId;
        foreach ($albumId as $i => $iValue) {
            $this->options['query']['AlbumId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
