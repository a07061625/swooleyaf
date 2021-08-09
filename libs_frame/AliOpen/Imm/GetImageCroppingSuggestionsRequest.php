<?php

namespace AliOpen\Imm;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetImageCroppingSuggestions
 *
 * @method string getProject()
 * @method string getAspectRatios()
 * @method string getImageUri()
 */
class GetImageCroppingSuggestionsRequest extends RpcAcsRequest
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
        parent::__construct('imm', '2017-09-06', 'GetImageCroppingSuggestions', 'imm');
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
     * @param string $aspectRatios
     *
     * @return $this
     */
    public function setAspectRatios($aspectRatios)
    {
        $this->requestParameters['AspectRatios'] = $aspectRatios;
        $this->queryParameters['AspectRatios'] = $aspectRatios;

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
