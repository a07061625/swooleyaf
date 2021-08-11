<?php

namespace AlibabaCloud\Imageprocess;

/**
 * @method string getOrgName()
 * @method string getMask()
 * @method string getDataFormat()
 * @method array getURLList()
 * @method string getOrgId()
 * @method string getAsync()
 */
class ScreenChestCT extends Rpc
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
    public function withMask($value)
    {
        $this->data['Mask'] = $value;
        $this->options['form_params']['Mask'] = $value;

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
