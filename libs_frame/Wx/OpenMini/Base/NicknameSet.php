<?php
/**
 * 小程序名称设置及改名
 * User: 姜伟
 * Date: 2018/9/13 0013
 * Time: 7:34
 */

namespace Wx\OpenMini\Base;

use SyConstant\ErrorCode;
use SyException\Wx\WxOpenException;
use SyTool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class NicknameSet extends WxBaseOpenMini
{
    /**
     * 应用ID
     *
     * @var string
     */
    private $appId = '';
    /**
     * 昵称
     *
     * @var string
     */
    private $nick_name = '';
    /**
     * 身份证照片
     *
     * @var string
     */
    private $id_card = '';
    /**
     * 营业执照
     *
     * @var string
     */
    private $license = '';
    /**
     * 其他证明材料列表
     *
     * @var array
     */
    private $naming_other_stuff_list = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxa/setnickname?access_token=';
        $this->appId = $appId;
    }

    public function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function setNickName(string $nickName)
    {
        if (\strlen($nickName) > 0) {
            $this->reqData['nick_name'] = $nickName;
        } else {
            throw new WxOpenException('昵称不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function setIdCard(string $idCard)
    {
        if (\strlen($idCard) > 0) {
            $this->reqData['id_card'] = $idCard;
        } else {
            throw new WxOpenException('身份证照片不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function setLicense(string $license)
    {
        if (\strlen($license) > 0) {
            $this->reqData['license'] = $license;
        } else {
            throw new WxOpenException('营业执照不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function setNamingOtherStuffList(array $namingOtherStuffList)
    {
        $this->naming_other_stuff_list = [];
        $num = 1;
        foreach ($namingOtherStuffList as $eNamingOtherStuff) {
            if ($num > 5) {
                break;
            }
            if (\is_string($eNamingOtherStuff) && (\strlen($eNamingOtherStuff) > 0)) {
                $key = 'naming_other_stuff_' . $num;
                $this->naming_other_stuff_list[$key] = $eNamingOtherStuff;
                ++$num;
            }
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['nick_name'])) {
            throw new WxOpenException('昵称不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        if ((!isset($this->reqData['id_card'])) && !isset($this->reqData['license'])) {
            throw new WxOpenException('身份证照片和营业执照至少要填一个', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        foreach ($this->naming_other_stuff_list as $key => $val) {
            $this->reqData[$key] = $val;
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getAuthorizerAccessToken($this->appId);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (0 == $sendData['errcode']) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WXOPEN_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
