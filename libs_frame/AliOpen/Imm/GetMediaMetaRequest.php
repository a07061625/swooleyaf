<?php

namespace AliOpen\Imm;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetMediaMeta
 *
 * @method string getMediaUri()
 * @method string getProject()
 */
class GetMediaMetaRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('imm', '2017-09-06', 'GetMediaMeta', 'imm');
    }

    /**
     * @param string $mediaUri
     *
     * @return $this
     */
    public function setMediaUri($mediaUri)
    {
        $this->requestParameters['MediaUri'] = $mediaUri;
        $this->queryParameters['MediaUri'] = $mediaUri;

        return $this;
    }

    /**
     * @param string $project
     *
     * @return $this
     */
    public function setProject($project)
    {
        $this->requestParameters['Project'] = $project;
        $this->queryParameters['Project'] = $project;

        return $this;
    }
}
