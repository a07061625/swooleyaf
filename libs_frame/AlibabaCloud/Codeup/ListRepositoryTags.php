<?php

namespace AlibabaCloud\Codeup;

/**
 * @method string getAccessToken()
 * @method string getShowSignature()
 * @method string getSort()
 * @method string getOrganizationId()
 * @method string getSearch()
 * @method string getPageSize()
 * @method string getPage()
 * @method string getProjectId()
 * @method $this withProjectId($value)
 */
class ListRepositoryTags extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v4/projects/[ProjectId]/repository/tags';

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
    public function withShowSignature($value)
    {
        $this->data['ShowSignature'] = $value;
        $this->options['query']['ShowSignature'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSort($value)
    {
        $this->data['Sort'] = $value;
        $this->options['query']['Sort'] = $value;

        return $this;
    }

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
    public function withSearch($value)
    {
        $this->data['Search'] = $value;
        $this->options['query']['Search'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageSize($value)
    {
        $this->data['PageSize'] = $value;
        $this->options['query']['PageSize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPage($value)
    {
        $this->data['Page'] = $value;
        $this->options['query']['Page'] = $value;

        return $this;
    }
}
