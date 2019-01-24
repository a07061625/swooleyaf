<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/7/18 0018
 * Time: 10:33
 */
namespace SyIM\Tencent;

use Constant\ErrorCode;
use Exception\IM\TencentException;

class UserImport {
    /**
     * 用户ID
     * @var string
     */
    private $userId = '';
    /**
     * 用户类型 0:普通用户 1:机器人用户
     * @var int
     */
    private $userType = 0;
    /**
     * 昵称
     * @var string
     */
    private $nickName = '';
    /**
     * 头像链接
     * @var string
     */
    private $headImage = '';
    
    public function __construct(){
    }
    
    private function __clone(){
    }

    /**
     * @return string
     */
    public function getUserId() : string {
        return $this->userId;
    }

    /**
     * @param string $userId
     * @throws \Exception\IM\TencentException
     */
    public function setUserId(string $userId){
        if(strlen($userId) <= 32){
            $this->userId = $userId;
        } else {
            throw new TencentException('用户ID不合法', ErrorCode::IM_PARAM_ERROR);
        }
    }

    /**
     * @return int
     */
    public function getUserType() : int {
        return $this->userType;
    }

    /**
     * @param int $userType
     * @throws \Exception\IM\TencentException
     */
    public function setUserType(int $userType){
        if(in_array($userType, [0, 1])){
            $this->userType = $userType;
        } else {
            throw new TencentException('用户类型不合法', ErrorCode::IM_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getNickName() : string {
        return $this->nickName;
    }

    /**
     * @param string $nickName
     */
    public function setNickName(string $nickName){
        $this->nickName = $nickName;
    }

    /**
     * @return string
     */
    public function getHeadImage() : string {
        return $this->headImage;
    }

    /**
     * @param string $headImage
     * @throws \Exception\IM\TencentException
     */
    public function setHeadImage(string $headImage){
        if(preg_match('/^(http|https)\:\/\/\S+$/', $headImage) > 0){
            $this->headImage = $headImage;
        } else {
            throw new TencentException('用户头像不合法', ErrorCode::IM_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        if(strlen($this->userId) == 0){
            throw new TencentException('用户ID不能为空', ErrorCode::IM_PARAM_ERROR);
        }
        if(strlen($this->nickName) == 0){
            throw new TencentException('用户头像不能为空', ErrorCode::IM_PARAM_ERROR);
        }

        return [
            'Identifier' => $this->userId,
            'Nick' => $this->nickName,
            'FaceUrl' => $this->headImage,
            'Type' => $this->userType,
        ];
    }
}