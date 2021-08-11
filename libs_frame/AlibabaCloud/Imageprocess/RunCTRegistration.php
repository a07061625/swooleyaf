<?php

namespace AlibabaCloud\Imageprocess;

/**
 * @method string getDataSourceType()
 * @method string getOrgName()
 * @method array getReferenceList()
 * @method string getDataFormat()
 * @method string getOrgId()
 * @method string getAsync()
 * @method array getFloatingList()
 */
class RunCTRegistration extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDataSourceType($value)
    {
        $this->data['DataSourceType'] = $value;
        $this->options['form_params']['DataSourceType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrgName($value)
    {
        $this->data['OrgName'] = $value;
        $this->options['form_params']['OrgName'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withReferenceList(array $referenceList)
    {
        $this->data['ReferenceList'] = $referenceList;
        foreach ($referenceList as $depth1 => $depth1Value) {
            if (isset($depth1Value['ReferenceURL'])) {
                $this->options['form_params']['ReferenceList.' . ($depth1 + 1) . '.ReferenceURL'] = $depth1Value['ReferenceURL'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDataFormat($value)
    {
        $this->data['DataFormat'] = $value;
        $this->options['form_params']['DataFormat'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrgId($value)
    {
        $this->data['OrgId'] = $value;
        $this->options['form_params']['OrgId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAsync($value)
    {
        $this->data['Async'] = $value;
        $this->options['form_params']['Async'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withFloatingList(array $floatingList)
    {
        $this->data['FloatingList'] = $floatingList;
        foreach ($floatingList as $depth1 => $depth1Value) {
            if (isset($depth1Value['FloatingURL'])) {
                $this->options['form_params']['FloatingList.' . ($depth1 + 1) . '.FloatingURL'] = $depth1Value['FloatingURL'];
            }
        }

        return $this;
    }
}
