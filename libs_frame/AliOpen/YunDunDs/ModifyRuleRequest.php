<?php

namespace AliOpen\YunDunDs;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ModifyRule
 *
 * @method string getSourceIp()
 * @method string getFeatureType()
 * @method string getName()
 * @method string getId()
 * @method string getRiskLevelId()
 * @method string getLang()
 * @method string getCustomType()
 * @method string getCategory()
 * @method string getContent()
 */
class ModifyRuleRequest extends RpcAcsRequest
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
        parent::__construct('Yundun-ds', '2019-01-03', 'ModifyRule', 'sddp');
    }

    /**
     * @param string $sourceIp
     *
     * @return $this
     */
    public function setSourceIp($sourceIp)
    {
        $this->requestParameters['SourceIp'] = $sourceIp;
        $this->queryParameters['SourceIp'] = $sourceIp;

        return $this;
    }

    /**
     * @param string $featureType
     *
     * @return $this
     */
    public function setFeatureType($featureType)
    {
        $this->requestParameters['FeatureType'] = $featureType;
        $this->queryParameters['FeatureType'] = $featureType;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->requestParameters['Name'] = $name;
        $this->queryParameters['Name'] = $name;

        return $this;
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->requestParameters['Id'] = $id;
        $this->queryParameters['Id'] = $id;

        return $this;
    }

    /**
     * @param string $riskLevelId
     *
     * @return $this
     */
    public function setRiskLevelId($riskLevelId)
    {
        $this->requestParameters['RiskLevelId'] = $riskLevelId;
        $this->queryParameters['RiskLevelId'] = $riskLevelId;

        return $this;
    }

    /**
     * @param string $lang
     *
     * @return $this
     */
    public function setLang($lang)
    {
        $this->requestParameters['Lang'] = $lang;
        $this->queryParameters['Lang'] = $lang;

        return $this;
    }

    /**
     * @param string $customType
     *
     * @return $this
     */
    public function setCustomType($customType)
    {
        $this->requestParameters['CustomType'] = $customType;
        $this->queryParameters['CustomType'] = $customType;

        return $this;
    }

    /**
     * @param string $category
     *
     * @return $this
     */
    public function setCategory($category)
    {
        $this->requestParameters['Category'] = $category;
        $this->queryParameters['Category'] = $category;

        return $this;
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setContent($content)
    {
        $this->requestParameters['Content'] = $content;
        $this->queryParameters['Content'] = $content;

        return $this;
    }
}
