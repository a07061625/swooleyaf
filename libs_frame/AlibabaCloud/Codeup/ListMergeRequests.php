<?php

namespace AlibabaCloud\Codeup;

/**
 * @method string getBeforeDate()
 * @method string getAssigneeIdList()
 * @method string getAccessToken()
 * @method string getSubscriberCodeupIdList()
 * @method string getAfterDate()
 * @method string getOrganizationId()
 * @method string getGroupIdList()
 * @method string getSearch()
 * @method string getAuthorCodeupIdList()
 * @method string getAuthorIdList()
 * @method string getPageSize()
 * @method string getProjectIdList()
 * @method string getPage()
 * @method string getAssigneeCodeupIdList()
 * @method string getState()
 * @method string getOrder()
 */
class ListMergeRequests extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v4/merge_requests/advanced_search';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBeforeDate($value)
    {
        $this->data['BeforeDate'] = $value;
        $this->options['query']['BeforeDate'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAssigneeIdList($value)
    {
        $this->data['AssigneeIdList'] = $value;
        $this->options['query']['AssigneeIdList'] = $value;

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
    public function withSubscriberCodeupIdList($value)
    {
        $this->data['SubscriberCodeupIdList'] = $value;
        $this->options['query']['SubscriberCodeupIdList'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAfterDate($value)
    {
        $this->data['AfterDate'] = $value;
        $this->options['query']['AfterDate'] = $value;

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
    public function withGroupIdList($value)
    {
        $this->data['GroupIdList'] = $value;
        $this->options['query']['GroupIdList'] = $value;

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
    public function withAuthorCodeupIdList($value)
    {
        $this->data['AuthorCodeupIdList'] = $value;
        $this->options['query']['AuthorCodeupIdList'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAuthorIdList($value)
    {
        $this->data['AuthorIdList'] = $value;
        $this->options['query']['AuthorIdList'] = $value;

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
    public function withProjectIdList($value)
    {
        $this->data['ProjectIdList'] = $value;
        $this->options['query']['ProjectIdList'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAssigneeCodeupIdList($value)
    {
        $this->data['AssigneeCodeupIdList'] = $value;
        $this->options['query']['AssigneeCodeupIdList'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withState($value)
    {
        $this->data['State'] = $value;
        $this->options['query']['State'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrder($value)
    {
        $this->data['Order'] = $value;
        $this->options['query']['Order'] = $value;

        return $this;
    }
}
