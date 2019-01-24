<?php
/**
 * @apiDefine CommonSuccess
 * @apiSuccess CommonSuccess 请求成功
 * @apiSuccessExample success:
 *     {
 *       "code": 0,
 *       "data": []
 *     }
 */

/**
 * @apiDefine CommonListSuccess
 * @apiSuccess CommonListSuccess 列表请求成功
 * @apiSuccessExample success-list:
 *     {
 *       "code": 0,
 *       "data": [
 *           "total": 1,
 *           "pages": 1,
 *           "current": 1,
 *           "data": []
 *       ]
 *     }
 */

/**
 * @apiDefine CommonFail
 * @apiSuccess CommonFail 请求失败
 * @apiSuccessExample fail:
 *     {
 *       "code": 10000,
 *       "msg": "id必须为整数"
 *     }
 */