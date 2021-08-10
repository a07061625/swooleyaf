<?php

namespace AlibabaCloud\EcsInc;

/**
 * @method string getTag4Value()
 * @method string getResourceId()
 * @method $this withResourceId($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getTag2Key()
 * @method string getTag5Key()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getFromRegionNo()
 * @method $this withFromRegionNo($value)
 * @method string getTag3Key()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getResourceType()
 * @method $this withResourceType($value)
 * @method string getTag5Value()
 * @method string getTag1Key()
 * @method string getTag1Value()
 * @method string getTag2Value()
 * @method string getTag4Key()
 * @method string getTag3Value()
 */
class DescribeCopyProgressAtOrigin extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag4Value($value)
    {
        $this->data['Tag4Value'] = $value;
        $this->options['query']['Tag.4.Value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag2Key($value)
    {
        $this->data['Tag2Key'] = $value;
        $this->options['query']['Tag.2.Key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag5Key($value)
    {
        $this->data['Tag5Key'] = $value;
        $this->options['query']['Tag.5.Key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag3Key($value)
    {
        $this->data['Tag3Key'] = $value;
        $this->options['query']['Tag.3.Key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag5Value($value)
    {
        $this->data['Tag5Value'] = $value;
        $this->options['query']['Tag.5.Value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag1Key($value)
    {
        $this->data['Tag1Key'] = $value;
        $this->options['query']['Tag.1.Key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag1Value($value)
    {
        $this->data['Tag1Value'] = $value;
        $this->options['query']['Tag.1.Value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag2Value($value)
    {
        $this->data['Tag2Value'] = $value;
        $this->options['query']['Tag.2.Value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag4Key($value)
    {
        $this->data['Tag4Key'] = $value;
        $this->options['query']['Tag.4.Key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag3Value($value)
    {
        $this->data['Tag3Value'] = $value;
        $this->options['query']['Tag.3.Value'] = $value;

        return $this;
    }
}
