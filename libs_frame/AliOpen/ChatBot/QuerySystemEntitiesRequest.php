<?php
namespace AliOpen\ChatBot;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of QuerySystemEntities
 *
 * @method string getEntityName()
 */
class QuerySystemEntitiesRequest extends RpcAcsRequest
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
            'QuerySystemEntities',
            'beebot'
        );
    }

    /**
     * @param string $entityName
     *
     * @return $this
     */
    public function setEntityName($entityName)
    {
        $this->requestParameters['EntityName'] = $entityName;
        $this->queryParameters['EntityName'] = $entityName;

        return $this;
    }
}
