<?php

namespace AlibabaCloud\Codeup;

/**
 * @method string getOrganizationId()
 * @method string getMergeRequestId()
 * @method $this withMergeRequestId($value)
 * @method string getFromCommit()
 * @method string getAccessToken()
 * @method string getToCommit()
 * @method string getProjectId()
 * @method $this withProjectId($value)
 */
class ListMergeRequestComments extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v4/projects/[ProjectId]/merge_request/[MergeRequestId]/comments';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrganizationId($value)
    {
        $this->data['OrganizationId'] = $value;
        $this->options['query']['OrganizationId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFromCommit($value)
    {
        $this->data['FromCommit'] = $value;
        $this->options['query']['FromCommit'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAccessToken($value)
    {
        $this->data['AccessToken'] = $value;
        $this->options['query']['AccessToken'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withToCommit($value)
    {
        $this->data['ToCommit'] = $value;
        $this->options['query']['ToCommit'] = $value;

        return $this;
    }
}
