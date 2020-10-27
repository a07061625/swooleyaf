<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/25 0025
 * Time: 15:37
 */
namespace Validator\Containers;

use SyConstant\ProjectBase;
use SyTool\BaseContainer;
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
use Validator\Impl\String\StringFrameToken;
use Validator\Impl\String\StringIP;
use Validator\Impl\String\StringJson;
use Validator\Impl\String\StringJwt;
use Validator\Impl\String\StringLat;
use Validator\Impl\String\StringLng;
use Validator\Impl\String\StringLower;
use Validator\Impl\String\StringMax;
use Validator\Impl\String\StringMin;
use Validator\Impl\String\StringNoEmoji;
use Validator\Impl\String\StringNoJs;
use Validator\Impl\String\StringPhone;
use Validator\Impl\String\StringRegex;
use Validator\Impl\String\StringRequestRate;
use Validator\Impl\String\StringRequired;
use Validator\Impl\String\StringSign;
use Validator\Impl\String\StringTel;
use Validator\Impl\String\StringUpper;
use Validator\Impl\String\StringUrl;
use Validator\Impl\String\StringZh;

/**
 * Class FrameContainer
 *
 * @package Validator\Containers
 */
class FrameContainer extends BaseContainer
{
    public function __construct()
    {
        $this->registryMap = [
            ProjectBase::VALIDATOR_TYPE_INT_REQUIRED => 1,
            ProjectBase::VALIDATOR_TYPE_INT_MIN => 1,
            ProjectBase::VALIDATOR_TYPE_INT_MAX => 1,
            ProjectBase::VALIDATOR_TYPE_INT_IN => 1,
            ProjectBase::VALIDATOR_TYPE_INT_BETWEEN => 1,
            ProjectBase::VALIDATOR_TYPE_DOUBLE_REQUIRED => 1,
            ProjectBase::VALIDATOR_TYPE_DOUBLE_BETWEEN => 1,
            ProjectBase::VALIDATOR_TYPE_DOUBLE_MIN => 1,
            ProjectBase::VALIDATOR_TYPE_DOUBLE_MAX => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_REQUIRED => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_MIN => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_MAX => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_REGEX => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_PHONE => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_TEL => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_EMAIL => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_URL => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_JSON => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_SIGN => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_BASE_IMAGE => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_IP => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_LNG => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_LAT => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_NO_JS => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_NO_EMOJI => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_ZH => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_ALNUM => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_ALPHA => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_DIGIT => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_DIGIT_LOWER => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_DIGIT_UPPER => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_LOWER => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_UPPER => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_FRAME_TOKEN => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_JWT => 1,
            ProjectBase::VALIDATOR_TYPE_STRING_REQUEST_RATE => 1,
        ];

        $this->bind(ProjectBase::VALIDATOR_TYPE_INT_REQUIRED, function () {
            return new IntRequired();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_INT_MIN, function () {
            return new IntMin();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_INT_MAX, function () {
            return new IntMax();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_INT_IN, function () {
            return new IntIn();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_INT_BETWEEN, function () {
            return new IntBetween();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_DOUBLE_REQUIRED, function () {
            return new DoubleRequired();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_DOUBLE_BETWEEN, function () {
            return new DoubleBetween();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_DOUBLE_MIN, function () {
            return new DoubleMin();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_DOUBLE_MAX, function () {
            return new DoubleMax();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_REQUIRED, function () {
            return new StringRequired();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_MIN, function () {
            return new StringMin();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_MAX, function () {
            return new StringMax();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_REGEX, function () {
            return new StringRegex();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_PHONE, function () {
            return new StringPhone();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_TEL, function () {
            return new StringTel();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_EMAIL, function () {
            return new StringEmail();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_URL, function () {
            return new StringUrl();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_JSON, function () {
            return new StringJson();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_SIGN, function () {
            return new StringSign();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_BASE_IMAGE, function () {
            return new StringBaseImage();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_IP, function () {
            return new StringIP();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_LNG, function () {
            return new StringLng();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_LAT, function () {
            return new StringLat();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_NO_JS, function () {
            return new StringNoJs();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_NO_EMOJI, function () {
            return new StringNoEmoji();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_ZH, function () {
            return new StringZh();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_ALNUM, function () {
            return new StringAlnum();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_ALPHA, function () {
            return new StringAlpha();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_DIGIT, function () {
            return new StringDigit();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_DIGIT_LOWER, function () {
            return new StringDigitLower();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_DIGIT_UPPER, function () {
            return new StringDigitUpper();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_LOWER, function () {
            return new StringLower();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_UPPER, function () {
            return new StringUpper();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_FRAME_TOKEN, function () {
            return new StringFrameToken();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_JWT, function () {
            return new StringJwt();
        });
        $this->bind(ProjectBase::VALIDATOR_TYPE_STRING_REQUEST_RATE, function () {
            return new StringRequestRate();
        });
    }
}
