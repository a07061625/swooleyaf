<?php

namespace AlibabaCloud\TeambitionAliyun;

/**
 * @method string getOrgName()
 * @method string getSource()
 * @method string getRealPk()
 * @method string getDesiredMemberCount()
 */
class CreateDevopsOrg extends Rpc
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
    public function withSource($value)
    {
        $this->data['Source'] = $value;
        $this->options['form_params']['Source'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRealPk($value)
    {
        $this->data['RealPk'] = $value;
        $this->options['form_params']['RealPk'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDesiredMemberCount($value)
    {
        $this->data['DesiredMemberCount'] = $value;
        $this->options['form_params']['DesiredMemberCount'] = $value;

        return $this;
    }
}
