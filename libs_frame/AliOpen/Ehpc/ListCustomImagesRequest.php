<?php

namespace AliOpen\Ehpc;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ListCustomImages
 *
 * @method string getBaseOsTag()
 * @method string getImageOwnerAlias()
 */
class ListCustomImagesRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('EHPC', '2018-04-12', 'ListCustomImages', 'ehs');
    }

    /**
     * @param string $baseOsTag
     *
     * @return $this
     */
    public function setBaseOsTag($baseOsTag)
    {
        $this->requestParameters['BaseOsTag'] = $baseOsTag;
        $this->queryParameters['BaseOsTag'] = $baseOsTag;

        return $this;
    }

    /**
     * @param string $imageOwnerAlias
     *
     * @return $this
     */
    public function setImageOwnerAlias($imageOwnerAlias)
    {
        $this->requestParameters['ImageOwnerAlias'] = $imageOwnerAlias;
        $this->queryParameters['ImageOwnerAlias'] = $imageOwnerAlias;

        return $this;
    }
}
