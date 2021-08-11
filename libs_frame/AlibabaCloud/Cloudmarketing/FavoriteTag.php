<?php

namespace AlibabaCloud\Cloudmarketing;

/**
 * @method string getTagId()
 * @method $this withTagId($value)
 * @method array getTagIds()
 * @method string getFavorite()
 * @method $this withFavorite($value)
 */
class FavoriteTag extends Rpc
{
    /**
     * @return $this
     */
    public function withTagIds(array $tagIds)
    {
        $this->data['TagIds'] = $tagIds;
        foreach ($tagIds as $i => $iValue) {
            $this->options['query']['TagIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
