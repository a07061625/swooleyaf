<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class PasswordPolicySetRequest extends RpcAcsRequest {
    private $requireNumbers;
    private $passwordReusePrevention;
    private $requireUppercaseCharacters;
    private $maxPasswordAge;
    private $maxLoginAttemps;
    private $hardExpiry;
    private $minimumPasswordLength;
    private $requireLowercaseCharacters;
    private $requireSymbols;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "SetPasswordPolicy");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getRequireNumbers(){
        return $this->requireNumbers;
    }

    public function setRequireNumbers($requireNumbers){
        $this->requireNumbers = $requireNumbers;
        $this->queryParameters["RequireNumbers"] = $requireNumbers;
    }

    public function getPasswordReusePrevention(){
        return $this->passwordReusePrevention;
    }

    public function setPasswordReusePrevention($passwordReusePrevention){
        $this->passwordReusePrevention = $passwordReusePrevention;
        $this->queryParameters["PasswordReusePrevention"] = $passwordReusePrevention;
    }

    public function getRequireUppercaseCharacters(){
        return $this->requireUppercaseCharacters;
    }

    public function setRequireUppercaseCharacters($requireUppercaseCharacters){
        $this->requireUppercaseCharacters = $requireUppercaseCharacters;
        $this->queryParameters["RequireUppercaseCharacters"] = $requireUppercaseCharacters;
    }

    public function getMaxPasswordAge(){
        return $this->maxPasswordAge;
    }

    public function setMaxPasswordAge($maxPasswordAge){
        $this->maxPasswordAge = $maxPasswordAge;
        $this->queryParameters["MaxPasswordAge"] = $maxPasswordAge;
    }

    public function getMaxLoginAttemps(){
        return $this->maxLoginAttemps;
    }

    public function setMaxLoginAttemps($maxLoginAttemps){
        $this->maxLoginAttemps = $maxLoginAttemps;
        $this->queryParameters["MaxLoginAttemps"] = $maxLoginAttemps;
    }

    public function getHardExpiry(){
        return $this->hardExpiry;
    }

    public function setHardExpiry($hardExpiry){
        $this->hardExpiry = $hardExpiry;
        $this->queryParameters["HardExpiry"] = $hardExpiry;
    }

    public function getMinimumPasswordLength(){
        return $this->minimumPasswordLength;
    }

    public function setMinimumPasswordLength($minimumPasswordLength){
        $this->minimumPasswordLength = $minimumPasswordLength;
        $this->queryParameters["MinimumPasswordLength"] = $minimumPasswordLength;
    }

    public function getRequireLowercaseCharacters(){
        return $this->requireLowercaseCharacters;
    }

    public function setRequireLowercaseCharacters($requireLowercaseCharacters){
        $this->requireLowercaseCharacters = $requireLowercaseCharacters;
        $this->queryParameters["RequireLowercaseCharacters"] = $requireLowercaseCharacters;
    }

    public function getRequireSymbols(){
        return $this->requireSymbols;
    }

    public function setRequireSymbols($requireSymbols){
        $this->requireSymbols = $requireSymbols;
        $this->queryParameters["RequireSymbols"] = $requireSymbols;
    }
}