<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/2/23 0023
 * Time: 13:59
 */
namespace DesignPatterns\Singletons;

use Constant\ProjectBase;
use Tool\BaseContainer;
use Traits\SingletonTrait;
use Validator\Impl\Double\DoubleBetween;
use Validator\Impl\Double\DoubleMax;
use Validator\Impl\Double\DoubleMin;
use Validator\Impl\Double\DoubleRequired;
use Validator\Impl\Int\IntBetween;
use Validator\Impl\Int\IntIn;
use Validator\Impl\Int\IntMax;
use Validator\Impl\Int\IntMin;
use Validator\Impl\Int\IntRequired;
use Validator\Impl\String\StringAlnum;
use Validator\Impl\String\StringAlpha;
use Validator\Impl\String\StringBaseImage;
use Validator\Impl\String\StringDigit;
use Validator\Impl\String\StringDigitLower;
use Validator\Impl\String\StringDigitUpper;
use Validator\Impl\String\StringEmail;
use Validator\Impl\String\StringIP;
use Validator\Impl\String\StringJson;
use Validator\Impl\String\StringLat;
use Validator\Impl\String\StringLng;
use Validator\Impl\String\StringLower;
use Validator\Impl\String\StringMax;
use Validator\Impl\String\StringMin;
use Validator\Impl\String\StringNoEmoji;
use Validator\Impl\String\StringNoJs;
use Validator\Impl\String\StringPhone;
use Validator\Impl\String\StringRegex;
use Validator\Impl\String\StringRequired;
use Validator\Impl\String\StringSign;
use Validator\Impl\String\StringSyToken;
use Validator\Impl\String\StringTel;
use Validator\Impl\String\StringUpper;
use Validator\Impl\String\StringUrl;
use Validator\Impl\String\StringZh;

class SimpleValidatorSingleton extends BaseContainer {
    use SingletonTrait;

    private function __construct(){
        $this->registryMap = [
            ProjectBase::VALIDATOR_INT_TYPE_REQUIRED => 1,
            ProjectBase::VALIDATOR_INT_TYPE_MIN => 1,
            ProjectBase::VALIDATOR_INT_TYPE_MAX => 1,
            ProjectBase::VALIDATOR_INT_TYPE_IN => 1,
            ProjectBase::VALIDATOR_INT_TYPE_BETWEEN => 1,
            ProjectBase::VALIDATOR_DOUBLE_TYPE_REQUIRED => 1,
            ProjectBase::VALIDATOR_DOUBLE_TYPE_BETWEEN => 1,
            ProjectBase::VALIDATOR_DOUBLE_TYPE_MIN => 1,
            ProjectBase::VALIDATOR_DOUBLE_TYPE_MAX => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_REQUIRED => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_MIN => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_MAX => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_REGEX => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_PHONE => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_TEL => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_EMAIL => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_URL => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_JSON => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_SIGN => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_BASE_IMAGE => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_IP => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_LNG => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_LAT => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_NO_JS => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_NO_EMOJI => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_ZH => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_ALNUM => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_ALPHA => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_DIGIT => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_DIGIT_LOWER => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_DIGIT_UPPER => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_LOWER => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_UPPER => 1,
            ProjectBase::VALIDATOR_STRING_TYPE_SY_TOKEN => 1,
        ];

        $this->bind(ProjectBase::VALIDATOR_INT_TYPE_REQUIRED, function () {
            return new IntRequired();
        });
        $this->bind(ProjectBase::VALIDATOR_INT_TYPE_MIN, function () {
            return new IntMin();
        });
        $this->bind(ProjectBase::VALIDATOR_INT_TYPE_MAX, function () {
            return new IntMax();
        });
        $this->bind(ProjectBase::VALIDATOR_INT_TYPE_IN, function () {
            return new IntIn();
        });
        $this->bind(ProjectBase::VALIDATOR_INT_TYPE_BETWEEN, function () {
            return new IntBetween();
        });
        $this->bind(ProjectBase::VALIDATOR_DOUBLE_TYPE_REQUIRED, function () {
            return new DoubleRequired();
        });
        $this->bind(ProjectBase::VALIDATOR_DOUBLE_TYPE_BETWEEN, function () {
            return new DoubleBetween();
        });
        $this->bind(ProjectBase::VALIDATOR_DOUBLE_TYPE_MIN, function () {
            return new DoubleMin();
        });
        $this->bind(ProjectBase::VALIDATOR_DOUBLE_TYPE_MAX, function () {
            return new DoubleMax();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_REQUIRED, function () {
            return new StringRequired();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_MIN, function () {
            return new StringMin();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_MAX, function () {
            return new StringMax();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_REGEX, function () {
            return new StringRegex();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_PHONE, function () {
            return new StringPhone();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_TEL, function () {
            return new StringTel();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_EMAIL, function () {
            return new StringEmail();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_URL, function () {
            return new StringUrl();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_JSON, function () {
            return new StringJson();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_SIGN, function () {
            return new StringSign();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_BASE_IMAGE, function () {
            return new StringBaseImage();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_IP, function () {
            return new StringIP();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_LNG, function () {
            return new StringLng();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_LAT, function () {
            return new StringLat();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_NO_JS, function () {
            return new StringNoJs();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_NO_EMOJI, function () {
            return new StringNoEmoji();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_ZH, function () {
            return new StringZh();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_ALNUM, function () {
            return new StringAlnum();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_ALPHA, function () {
            return new StringAlpha();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_DIGIT, function () {
            return new StringDigit();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_DIGIT_LOWER, function () {
            return new StringDigitLower();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_DIGIT_UPPER, function () {
            return new StringDigitUpper();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_LOWER, function () {
            return new StringLower();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_UPPER, function () {
            return new StringUpper();
        });
        $this->bind(ProjectBase::VALIDATOR_STRING_TYPE_SY_TOKEN, function () {
            return new StringSyToken();
        });
    }

    /**
     * @return \DesignPatterns\Singletons\SimpleValidatorSingleton
     */
    public static function getInstance() {
        if(is_null(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }
}