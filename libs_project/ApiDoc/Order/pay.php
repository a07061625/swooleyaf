<?php
/**
 * @apiDefine OrderPayModelWxJs
 * @apiParam {string{1..64}} _sytoken 令牌标识
 */

/**
 * @apiDefine OrderPayModelAliCode
 * @apiParam {string{0..20}} ali_timeout 订单过期时间
 */

/**
 * @apiDefine OrderPayModelAliWeb
 * @apiParam {string{1..255}} ali_returnurl 同步通知URL地址
 * @apiParam {string{0..20}} ali_timeout 订单过期时间
 */

/**
 * @apiDefine OrderPayContentGoods
 * @apiParam {number{1..}} goods_id 商品ID
 */