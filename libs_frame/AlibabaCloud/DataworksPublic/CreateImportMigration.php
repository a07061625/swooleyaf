<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getDescription()
 * @method string getCommitRule()
 * @method string getWorkspaceMap()
 * @method string getCalculateEngineMap()
 * @method string getPackageFile()
 * @method string getName()
 * @method string getPackageType()
 * @method string getProjectId()
 * @method string getResourceGroupMap()
 */
class CreateImportMigration extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDescription($value)
    {
        $this->data['Description'] = $value;
        $this->options['form_params']['Description'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCommitRule($value)
    {
        $this->data['CommitRule'] = $value;
        $this->options['form_params']['CommitRule'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withWorkspaceMap($value)
    {
        $this->data['WorkspaceMap'] = $value;
        $this->options['form_params']['WorkspaceMap'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCalculateEngineMap($value)
    {
        $this->data['CalculateEngineMap'] = $value;
        $this->options['form_params']['CalculateEngineMap'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPackageFile($value)
    {
        $this->data['PackageFile'] = $value;
        $this->options['form_params']['PackageFile'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withName($value)
    {
        $this->data['Name'] = $value;
        $this->options['form_params']['Name'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPackageType($value)
    {
        $this->data['PackageType'] = $value;
        $this->options['form_params']['PackageType'] = $value;

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
    public function withResourceGroupMap($value)
    {
        $this->data['ResourceGroupMap'] = $value;
        $this->options['form_params']['ResourceGroupMap'] = $value;

        return $this;
    }
}
