<?php
/**
 * @apiDefine ResponseSuccess
 * @apiSuccess {Number} code 状态码,0
 * @apiSuccess {Number} now_time 请求时间戳
 * @apiSuccess {String} req_id 请求ID
 * @apiSuccess {Object} data 响应数据
 */

/**
 * @apiDefine ResponseSuccessList
 * @apiSuccess {Number} code 状态码,0
 * @apiSuccess {Number} now_time 请求时间戳
 * @apiSuccess {String} req_id 请求ID
 * @apiSuccess {Object} data 响应数据
 * @apiSuccess {Number} data.current 当前页
 * @apiSuccess {Number} data.pages 总页数
 * @apiSuccess {Number} data.limit 每页记录条数
 * @apiSuccess {Number} data.total 总记录条数
 * @apiSuccess {Object[]} data.data 响应数据列表
 */

/**
 * @apiDefine ResponseSuccessEdit
 * @apiSuccess {Number} code 状态码,0
 * @apiSuccess {Number} now_time 请求时间戳
 * @apiSuccess {String} req_id 请求ID
 * @apiSuccess {Object} data 响应数据
 * @apiSuccess {String} data.msg 修改结果
 */

/**
 * @apiDefine ResponseFail
 * @apiError (200) {Number} code 状态码,大于0
 * @apiError (200) {Number} now_time 请求时间戳
 * @apiError (200) {String} req_id 请求ID
 * @apiError (200) {String} msg 出错信息描述
 * @apiErrorExample {json} Response-Fail
 *   {
 *     "code": 10001,
 *     "req_id": "7461ab3e352eae5b4317009a5e2fcfe2",
 *     "now_time": 1587455747,
 *     "msg": "id必须为整数"
 *   }
 */

/**
 * @apiDefine RequestSession
 * @apiHeader {String} [Sy-Auth] 会话标识,数字和小写字母组成的16位长度字符串,会话标识和会话ID至少要选择一个
 * @apiParam {string} [session_id] 会话ID,数字和小写字母组成的16位长度字符串,会话标识和会话ID至少要选择一个
 * @apiHeaderExample {json} Session-Request-Header
 *   {
 *     "Sy-Auth": "0eihbc1587865998"
 *   }
 * @apiParamExample {json} Session-Request-Param
 *   {
 *     "session_id": "0eihbc1587865998"
 *   }
 */

/**
 * @apiDefine RequestSign
 * @apiHeader {String} [Sy-Sign] 接口签名,数字和小写字母组成的48位长度字符串
 * @apiParam {string} [_sign] 接口签名,数字和小写字母组成的48位长度字符串
 * @apiHeaderExample {json} Sign-Request-Header
 *   {
 *     "Sy-Sign": "0eihbc1587865998fdsafsadfdsafsadfdsafsad"
 *   }
 * @apiParamExample {json} Sign-Request-Param
 *   {
 *     "_sign": "0eihbc1587865998fdsafsadfdsafsadfdsafsad"
 *   }
 */
