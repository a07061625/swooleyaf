<?php
/**
 * @apiDefine UserLoginAccount
 * @apiParam {number=1,2,3} user_type 用户类型 1：用户 2：商家 3：联盟
 * @apiParam {string} user_account 用户账号
 * @apiParam {string} user_pwd 用户密码
 */

/**
 * @apiDefine UserLoginEmail
 * @apiParam {number=1,2,3} user_type 用户类型 1：用户 2：商家 3：联盟
 * @apiParam {string} user_email 用户邮箱
 * @apiParam {string} user_pwd 用户密码
 */

/**
 * @apiDefine UserLoginPhone
 * @apiParam {number=1,2,3} user_type 用户类型 1：用户 2：商家 3：联盟
 * @apiParam {string} user_phone 用户手机号码
 * @apiParam {string} user_pwd 用户密码
 */

/**
 * @apiDefine UserLoginQQ
 * @apiParam {number=1,2,3} user_type 用户类型 1：用户 2：商家 3：联盟
 * @apiParam {string} user_qq 用户QQ
 * @apiParam {string} user_pwd 用户密码
 */

/**
 * @apiDefine UserLoginWxAuthBase
 * @apiParam {number=1,2,3} user_type 用户类型 1：用户 2：商家 3：联盟
 * @apiParam {string} wx_code 微信授权码
 * @apiParam {string} redirect_url 回跳URL地址
 */

/**
 * @apiDefine UserLoginWxAuthUser
 * @apiParam {number=1,2,3} user_type 用户类型 1：用户 2：商家 3：联盟
 * @apiParam {string} wx_code 微信授权码
 * @apiParam {string} redirect_url 回跳URL地址
 */

/**
 * @apiDefine UserLoginWxScan
 * @apiParam {number=1,2,3} user_type 用户类型 1：用户 2：商家 3：联盟
 * @apiParam {string} wx_code 微信授权码
 * @apiParam {string} redirect_url 回跳URL地址
 */