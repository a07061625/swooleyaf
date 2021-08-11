<?php

namespace AlibabaCloud\Alinlp;

/**
 * @method string getFactory()
 * @method string getSpecification()
 * @method string getUnit()
 * @method string getServiceCode()
 * @method string getName()
 */
class GetMedicineChMedical extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFactory($value)
    {
        $this->data['Factory'] = $value;
        $this->options['form_params']['Factory'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSpecification($value)
    {
        $this->data['Specification'] = $value;
        $this->options['form_params']['Specification'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUnit($value)
    {
        $this->data['Unit'] = $value;
        $this->options['form_params']['Unit'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withServiceCode($value)
    {
        $this->data['ServiceCode'] = $value;
        $this->options['form_params']['ServiceCode'] = $value;

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
}
