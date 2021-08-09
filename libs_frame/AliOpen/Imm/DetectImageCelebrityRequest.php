<?php

namespace AliOpen\Imm;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DetectImageCelebrity
 *
 * @method string getProject()
 * @method string getLibrary()
 * @method string getRealUid()
 * @method string getImageUri()
 */
class DetectImageCelebrityRequest extends RpcAcsRequest
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
        parent::__construct('imm', '2017-09-06', 'DetectImageCelebrity', 'imm');
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

    /**
     * @param string $library
     *
     * @return $this
     */
    public function setLibrary($library)
    {
        $this->requestParameters['Library'] = $library;
        $this->queryParameters['Library'] = $library;

        return $this;
    }

    /**
     * @param string $realUid
     *
     * @return $this
     */
    public function setRealUid($realUid)
    {
        $this->requestParameters['RealUid'] = $realUid;
        $this->queryParameters['RealUid'] = $realUid;

        return $this;
    }

    /**
     * @param string $imageUri
     *
     * @return $this
     */
    public function setImageUri($imageUri)
    {
        $this->requestParameters['ImageUri'] = $imageUri;
        $this->queryParameters['ImageUri'] = $imageUri;

        return $this;
    }
}
