<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getOutputList()
 * @method string getDependentNodeIdList()
 * @method string getContent()
 * @method string getProjectIdentifier()
 * @method string getProjectId()
 * @method string getStartEffectDate()
 * @method string getCycleType()
 * @method string getFileId()
 * @method string getAutoRerunIntervalMillis()
 * @method string getOwner()
 * @method string getInputList()
 * @method string getRerunMode()
 * @method string getConnectionName()
 * @method string getParaValue()
 * @method string getResourceGroupIdentifier()
 * @method string getAutoRerunTimes()
 * @method string getCronExpress()
 * @method string getEndEffectDate()
 * @method string getFileName()
 * @method string getStop()
 * @method string getDependentType()
 * @method string getFileFolderPath()
 * @method string getFileDescription()
 * @method string getAutoParsing()
 */
class UpdateFile extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOutputList($value)
    {
        $this->data['OutputList'] = $value;
        $this->options['form_params']['OutputList'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDependentNodeIdList($value)
    {
        $this->data['DependentNodeIdList'] = $value;
        $this->options['form_params']['DependentNodeIdList'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withContent($value)
    {
        $this->data['Content'] = $value;
        $this->options['form_params']['Content'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectIdentifier($value)
    {
        $this->data['ProjectIdentifier'] = $value;
        $this->options['form_params']['ProjectIdentifier'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectId($value)
    {
        $this->data['ProjectId'] = $value;
        $this->options['form_params']['ProjectId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStartEffectDate($value)
    {
        $this->data['StartEffectDate'] = $value;
        $this->options['form_params']['StartEffectDate'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCycleType($value)
    {
        $this->data['CycleType'] = $value;
        $this->options['form_params']['CycleType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFileId($value)
    {
        $this->data['FileId'] = $value;
        $this->options['form_params']['FileId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAutoRerunIntervalMillis($value)
    {
        $this->data['AutoRerunIntervalMillis'] = $value;
        $this->options['form_params']['AutoRerunIntervalMillis'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOwner($value)
    {
        $this->data['Owner'] = $value;
        $this->options['form_params']['Owner'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInputList($value)
    {
        $this->data['InputList'] = $value;
        $this->options['form_params']['InputList'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRerunMode($value)
    {
        $this->data['RerunMode'] = $value;
        $this->options['form_params']['RerunMode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withConnectionName($value)
    {
        $this->data['ConnectionName'] = $value;
        $this->options['form_params']['ConnectionName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withParaValue($value)
    {
        $this->data['ParaValue'] = $value;
        $this->options['form_params']['ParaValue'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withResourceGroupIdentifier($value)
    {
        $this->data['ResourceGroupIdentifier'] = $value;
        $this->options['form_params']['ResourceGroupIdentifier'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAutoRerunTimes($value)
    {
        $this->data['AutoRerunTimes'] = $value;
        $this->options['form_params']['AutoRerunTimes'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCronExpress($value)
    {
        $this->data['CronExpress'] = $value;
        $this->options['form_params']['CronExpress'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndEffectDate($value)
    {
        $this->data['EndEffectDate'] = $value;
        $this->options['form_params']['EndEffectDate'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFileName($value)
    {
        $this->data['FileName'] = $value;
        $this->options['form_params']['FileName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStop($value)
    {
        $this->data['Stop'] = $value;
        $this->options['form_params']['Stop'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDependentType($value)
    {
        $this->data['DependentType'] = $value;
        $this->options['form_params']['DependentType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFileFolderPath($value)
    {
        $this->data['FileFolderPath'] = $value;
        $this->options['form_params']['FileFolderPath'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFileDescription($value)
    {
        $this->data['FileDescription'] = $value;
        $this->options['form_params']['FileDescription'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAutoParsing($value)
    {
        $this->data['AutoParsing'] = $value;
        $this->options['form_params']['AutoParsing'] = $value;

        return $this;
    }
}
