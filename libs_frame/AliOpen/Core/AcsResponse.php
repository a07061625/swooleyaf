<?php
namespace AliOpen\Core;

class AcsResponse {
    /**
     * @var string
     */
    private $code;
    /**
     * @var string
     */
    private $message;

    /**
     * @return string
     */
    public function getCode(){
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code){
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getMessage(){
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message){
        $this->message = $message;
    }
}
