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
 * @apiSuccess {Number} current 当前页
 * @apiSuccess {Number} pages 总页数
 * @apiSuccess {Number} limit 每页记录条数
 * @apiSuccess {Number} total 总记录条数
 * @apiSuccess {Object[]} data 响应数据列表
 */

/**
 * @apiDefine ResponseFail
 * @apiError (200) {Number} code 状态码,大于0
 * @apiError (200) {Number} now_time 请求时间戳
 * @apiError (200) {String} req_id 请求ID
 * @apiError (200) {String} msg 出错信息描述
 * @apiErrorExample {json} fail:
 *     {
 *       "code": 10001,
 *       "req_id": "7461ab3e352eae5b4317009a5e2fcfe2",
 *       "now_time": 1587455747,
 *       "msg": "id必须为整数"
 *     }
 */
