<?php
/**
 * 发送语音验证码
 * User: 姜伟
 * Date: 2020/5/6 0006
 * Time: 19:54
 */
namespace SyVms\QCloud;

use SyConstant\ErrorCode;
use SyException\Vms\QCloudException;
use SyVms\BaseQCloud;

/**
 * Class CodeVoiceSend
 *
 * @package SyVms\QCloud
 */
class CodeVoiceSend extends BaseQCloud
{
    /**
     * 用户session内容
     *
     * @var string
     */
    private $ext = '';
    /**
     * 验证码
     *
     * @var string
     */
    private $msg = '';
    /**
     * 播放次数
     *
     * @var int
     */
    private $playTimes = 0;
    /**
     * 电话号码
     *
     * @var string
     */
    private $telMobile = '';
    /**
     * 国家码
     *
     * @var string
     */
    private $telNationCode = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://cloud.tim.qq.com/v5/tlsvoicesvr/sendcvoice';
        $this->reqData = [
            'ext' => '',
            'playtimes' => 2,
            'tel' => [
                'nationcode' => '86',
            ],
        ];
    }

    private function __clone()
    {
    }

    /**
     * @param string $ext
     */
    public function setExt(string $ext)
    {
        $this->reqData['ext'] = trim($ext);
    }

    /**
     * @param string $msg
     *
     * @throws \SyException\Vms\QCloudException
     */
    public function setMsg(string $msg)
    {
        if (ctype_digit($msg)) {
            $this->reqData['msg'] = $msg;
        } else {
            throw new QCloudException('验证码不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    /**
     * @param int $playTimes
     *
     * @throws \SyException\Vms\QCloudException
     */
    public function setPlayTimes(int $playTimes)
    {
        if (($playTimes > 0) && ($playTimes <= 3)) {
            $this->reqData['playtimes'] = $playTimes;
        } else {
            throw new QCloudException('播放次数不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    /**
     * @param string $telMobile
     *
     * @throws \SyException\Vms\QCloudException
     */
    public function setTelMobile(string $telMobile)
    {
        if (ctype_digit($telMobile)) {
            $this->reqData['tel']['mobile'] = $telMobile;
        } else {
            throw new QCloudException('电话号码不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    /**
     * @param string $telNationCode
     *
     * @throws \SyException\Vms\QCloudException
     */
    public function setTelNationCode(string $telNationCode)
    {
        if (ctype_digit($telNationCode)) {
            $this->reqData['tel']['nationcode'] = $telNationCode;
        } else {
            throw new QCloudException('国家码不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['msg'])) {
            throw new QCloudException('验证码不能为空', ErrorCode::VMS_PARAM_ERROR);
        }
        if (!isset($this->reqData['tel']['mobile'])) {
            throw new QCloudException('电话号码不能为空', ErrorCode::VMS_PARAM_ERROR);
        }
        $this->refreshSign([
            'mobile' => $this->reqData['tel']['mobile'],
        ]);

        return $this->curlConfigs;
    }
}
