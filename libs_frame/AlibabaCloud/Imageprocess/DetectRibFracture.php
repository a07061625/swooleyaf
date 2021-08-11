<?php

namespace AlibabaCloud\Imageprocess;

/**
 * @method string getOrgName()
 * @method string getSourceType()
 * @method string getDataFormat()
 * @method array getURLList()
 * @method string getOrgId()
 * @method string getAsync()
 */
class DetectRibFracture extends Rpc
{
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
     * @param string $value
     *
     * @return $this
     */
    public function withSourceType($value)
    {
        $this->data['SourceType'] = $value;
        $this->options['form_params']['SourceType'] = $value;

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
     * @return $this
     */
    public function withURLList(array $uRLList)
    {
        $this->data['URLList'] = $uRLList;
        foreach ($uRLList as $depth1 => $depth1Value) {
            if (isset($depth1Value['URL'])) {
                $this->options['form_params']['URLList.' . ($depth1 + 1) . '.URL'] = $depth1Value['URL'];
            }
        }

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
}
