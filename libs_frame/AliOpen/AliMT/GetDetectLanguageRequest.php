<?php

namespace AliOpen\AliMT;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetDetectLanguage
 *
 * @method string getSourceText()
 */
class GetDetectLanguageRequest extends RpcAcsRequest
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
        parent::__construct(
            'alimt',
            '2018-10-12',
            'GetDetectLanguage',
            'alimt'
        );
    }

    /**
     * @param string $sourceText
     *
     * @return $this
     */
    public function setSourceText($sourceText)
    {
        $this->requestParameters['SourceText'] = $sourceText;
        $this->queryParameters['SourceText'] = $sourceText;

        return $this;
    }
}
