<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/22 0022
 * Time: 11:05
 */

namespace Wx\Corp\User;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseCorp;
use Wx\WxTraitCorp;
use Wx\WxUtilBase;

/**
 * 获取部门成员
 *
 * @package Wx\Corp\User
 */
class UserSimpleList extends WxBaseCorp
{
    use WxTraitCorp;

    /**
     * 部门id
     *
     * @var int
     */
    private $department_id = 0;
    /**
     * 匹配子部门标识 0:不匹配 1:匹配
     *
     * @var int
     */
    private $fetch_child = 0;

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/user/simplelist';
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['fetch_child'] = 0;
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setDepartmentId(int $departmentId)
    {
        if ($departmentId > 0) {
            $this->reqData['department_id'] = $departmentId;
        } else {
            throw new WxException('部门id不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setFetchChild(int $fetchChild)
    {
        if (\in_array($fetchChild, [0, 1], true)) {
            $this->reqData['fetch_child'] = $fetchChild;
        } else {
            throw new WxException('匹配子部门标识不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['department_id'])) {
            throw new WxException('部门id不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->reqData['access_token'] = $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . '?' . http_build_query($this->reqData);
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (0 == $sendData['errcode']) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_GET_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
