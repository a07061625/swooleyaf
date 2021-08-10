<?php

namespace AlibabaCloud\TeambitionAliyun;

/**
 * @method string getApplicantEmail()
 * @method string getDevelopScale()
 * @method $this withDevelopScale($value)
 * @method string getType()
 * @method string getOrgId()
 * @method string getApplicantPosition()
 * @method string getDevelopLanguage()
 * @method string getOrgName()
 * @method string getApplicantTel()
 * @method string getSolution()
 * @method string getForHelp()
 * @method string getApplicantName()
 * @method string getBusinessModel()
 */
class ApplySmallMicro extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApplicantEmail($value)
    {
        $this->data['ApplicantEmail'] = $value;
        $this->options['form_params']['ApplicantEmail'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withType($value)
    {
        $this->data['Type'] = $value;
        $this->options['form_params']['Type'] = $value;

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
    public function withApplicantPosition($value)
    {
        $this->data['ApplicantPosition'] = $value;
        $this->options['form_params']['ApplicantPosition'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDevelopLanguage($value)
    {
        $this->data['DevelopLanguage'] = $value;
        $this->options['form_params']['DevelopLanguage'] = $value;

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
     * @param string $value
     *
     * @return $this
     */
    public function withApplicantTel($value)
    {
        $this->data['ApplicantTel'] = $value;
        $this->options['form_params']['ApplicantTel'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSolution($value)
    {
        $this->data['Solution'] = $value;
        $this->options['form_params']['Solution'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withForHelp($value)
    {
        $this->data['ForHelp'] = $value;
        $this->options['form_params']['ForHelp'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApplicantName($value)
    {
        $this->data['ApplicantName'] = $value;
        $this->options['form_params']['ApplicantName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBusinessModel($value)
    {
        $this->data['BusinessModel'] = $value;
        $this->options['form_params']['BusinessModel'] = $value;

        return $this;
    }
}
