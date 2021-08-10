<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getName()
 * @method string getTelephone()
 * @method string getEmail()
 */
class UpdateAccountInfo extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/account/edit_account_info';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withName($value)
    {
        $this->data['Name'] = $value;
        $this->options['query']['Name'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTelephone($value)
    {
        $this->data['Telephone'] = $value;
        $this->options['query']['Telephone'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEmail($value)
    {
        $this->data['Email'] = $value;
        $this->options['query']['Email'] = $value;

        return $this;
    }
}
