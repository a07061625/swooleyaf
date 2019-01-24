<?php
/**
 * @apiDefine ServiceImageUploadTypeBase64
 * @apiParam {string} image_base64 图片base64编码
 */

/**
 * @apiDefine ServiceImageUploadTypeUrl
 * @apiParam {string} image_url 图片链接
 */

/**
 * @apiDefine ServiceImageUploadContentNormal
 * @apiParam {number{1-4000}} image_width 图片限定宽度
 * @apiParam {number{1-4000}} image_height 图片限定高度
 */

/**
 * @apiDefine ServiceImageUploadContentPuzzle
 * @apiParam {number{1-4000}} image_width 图片限定宽度
 * @apiParam {number{1-4000}} image_height 图片限定高度
 * @apiParam {number=4,9} cut_num 图片切分块数
 */