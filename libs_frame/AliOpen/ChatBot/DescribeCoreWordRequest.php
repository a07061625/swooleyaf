<?php

namespace AliOpen\ChatBot;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeCoreWord
 *
 * @method string getCoreWordName()
 */
class DescribeCoreWordRequest extends RpcAcsRequest
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
            'Chatbot',
            '2017-10-11',
            'DescribeCoreWord',
            'beebot'
        );
    }

    /**
     * @param string $coreWordName
     *
     * @return $this
     */
    public function setCoreWordName($coreWordName)
    {
        $this->requestParameters['CoreWordName'] = $coreWordName;
        $this->queryParameters['CoreWordName'] = $coreWordName;

        return $this;
    }
}
