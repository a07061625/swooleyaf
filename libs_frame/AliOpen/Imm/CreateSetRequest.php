<?php

namespace AliOpen\Imm;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CreateSet
 *
 * @method string getProject()
 * @method string getSetName()
 * @method string getSetId()
 */
class CreateSetRequest extends RpcAcsRequest
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
        parent::__construct('imm', '2017-09-06', 'CreateSet', 'imm');
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
     * @param string $setName
     *
     * @return $this
     */
    public function setSetName($setName)
    {
        $this->requestParameters['SetName'] = $setName;
        $this->queryParameters['SetName'] = $setName;

        return $this;
    }

    /**
     * @param string $setId
     *
     * @return $this
     */
    public function setSetId($setId)
    {
        $this->requestParameters['SetId'] = $setId;
        $this->queryParameters['SetId'] = $setId;

        return $this;
    }
}
