<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/22 0022
 * Time: 11:05
 */
namespace Wx\Corp\Department;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseCorp;
use Wx\WxTraitCorp;
use Wx\WxUtilBase;

/**
 * 创建部门
 * @package Wx\Corp\Department
 */
class DepartmentCreate extends WxBaseCorp
{
    use WxTraitCorp;

    /**
     * 名称
     * @var string
     */
    private $name = '';
    /**
     * 父部门id
     * @var int
     */
    private $parentid = 0;
    /**
     * 排序值,数字越大越靠前
     * @var int
     */
    private $order = 0;
    /**
     * 部门id
     * @var int
     */
    private $id = 0;

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/department/create?access_token=';
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['order'] = 0;
        $this->reqData['parentid'] = 0;
    }

    private function __clone()
    {
    }

    /**
     * @param string $name
     * @throws \SyException\Wx\WxException
     */
    public function setName(string $name)
    {
        if (strlen($name) > 0) {
            $this->reqData['name'] = mb_substr($name, 0, 16);
        } else {
            throw new WxException('名称不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param int $parentId
     * @throws \SyException\Wx\WxException
     */
    public function setParentId(int $parentId)
    {
        if ($parentId >= 0) {
            $this->reqData['parentid'] = $parentId;
        } else {
            throw new WxException('父部门id不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param int $order
     * @throws \SyException\Wx\WxException
     */
    public function setOrder(int $order)
    {
        if ($order >= 0) {
            $this->reqData['order'] = $order;
        } else {
            throw new WxException('排序值不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param int $id
     * @throws \SyException\Wx\WxException
     */
    public function setId(int $id)
    {
        if ($id > 0) {
            $this->reqData['id'] = $id;
        } else {
            throw new WxException('部门id不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['name'])) {
            throw new WxException('名称不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
