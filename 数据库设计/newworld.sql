
/*
lyx
2018.06.10
*/
ALTER TABLE `u_note_comment`
ADD COLUMN `note_comment_isreply`  smallint(3) NOT NULL DEFAULT 0 COMMENT '是否回复，0为否，1为是' AFTER `note_comment_zaner`;

ALTER TABLE `u_note_vi`
MODIFY COLUMN `note_vi_id`  bigint(20) NOT NULL AUTO_INCREMENT COMMENT '帖子的视频图片表自增id' FIRST ;


ALTER TABLE `u_note_vi`
ADD COLUMN `note_vi_type`  smallint(3) NULL COMMENT '文件类型，1为图片，2为视频' AFTER `note_vi_url`;

ALTER TABLE `u_question_vi`
ADD COLUMN `question_vi_type`  smallint(3) NULL COMMENT '文件类型,1为图片，2为视频' AFTER `question_vi_url`;
ALTER TABLE `newworld`.`u_firends`
ADD COLUMN `firends_mark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '备注名' AFTER `firends_createtime`;

ALTER TABLE `newworld`.`u_message`
ADD COLUMN `message_type` tinyint UNSIGNED NOT NULL  COMMENT '信息类型 0：系统提示 1：好友申请' AFTER `message_isread`;

ALTER TABLE `newworld`.`u_message` 
MODIFY COLUMN `message_sendtime` datetime(0) NOT NULL COMMENT '信息发送时间' AFTER `message_content`,
MODIFY COLUMN `message_delivertime` datetime(0) NOT NULL COMMENT '信息送达时间' AFTER `message_sendtime`;

/*
lyx
2018.06.13 start
*/

ALTER TABLE `u_crowd`
ADD COLUMN `crowd_scool`  varchar(255) NULL COMMENT '毕业院校' AFTER `crowd_icon`;

ALTER TABLE `u_crowd`
ADD COLUMN `crowd_scooltime`  varchar(255) NULL COMMENT '毕业时间' AFTER `crowd_scool`;

ALTER TABLE `u_crowd`
ADD COLUMN `crowd_profession`  varchar(255) NULL COMMENT '职业岗位' AFTER `crowd_scooltime`;

ALTER TABLE `u_crowd`
ADD COLUMN `crowd_company`  varchar(255) NULL COMMENT '在职公司' AFTER `crowd_profession`;

ALTER TABLE `u_crowd`
ADD COLUMN `crowd_help`  text NULL COMMENT '能够提供的帮助' AFTER `crowd_company`;

/*
lyx
2018.06.13 end
*/


/*
lyx
2018.06.15 start
*/

ALTER TABLE `u_note`
ADD COLUMN `note_haveanswer`  smallint(3) NOT NULL DEFAULT 0 COMMENT '0为还没选择答案，1为选择答案了' AFTER `note_reward`;

/*
lyx
2018.06.15 end
*/

ALTER TABLE `newworld`.`u_concerns` 
ADD COLUMN `concerns_status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0：取消关注 1 关注' AFTER `concerns_cuid`;

/*
lyx
2018.06.19 start
*/

ALTER TABLE `u_tutorship_issue`
ADD COLUMN `tutorship_issue_istop`  smallint(1) NOT NULL DEFAULT 0 COMMENT '是否置顶，0为不置顶，1为置顶' AFTER `tutorship_issue_explain`;

ALTER TABLE `u_tutorship_issue`
ADD COLUMN `tutorship_issue_iswally`  smallint(1) NOT NULL DEFAULT 0 COMMENT '是否为精品，0为否，1为是' AFTER `tutorship_issue_istop`;

ALTER TABLE `u_tutorship_issue`
ADD COLUMN `tutorship_issue_ishide`  smallint(1) NOT NULL DEFAULT 1 COMMENT '是否屏蔽，0为已屏蔽，1为未屏蔽' AFTER `tutorship_issue_iswally`;

ALTER TABLE `u_tutorship_issue`
MODIFY COLUMN `tutorship_issue_explain`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '备注' AFTER `tutorship_issue_content`;

ALTER TABLE `u_tutorship_need`
MODIFY COLUMN `tutorship_need_explain`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '备注' AFTER `tutorship_need_content`;

ALTER TABLE `u_tutorship_need`
ADD COLUMN `tutorship_need_istop`  smallint(1) NOT NULL DEFAULT 0 COMMENT '是否置顶，0为不置顶，1为置顶' AFTER `tutorship_need_explain`;

ALTER TABLE `u_tutorship_need`
ADD COLUMN `tutorship_need_iswally`  smallint(1) NOT NULL DEFAULT 0 COMMENT '是否为精品，0为否，1为是' AFTER `tutorship_need_istop`;

ALTER TABLE `u_tutorship_need`
ADD COLUMN `tutorship_need_ishide`  smallint(1) NOT NULL DEFAULT 1 COMMENT '是否屏蔽，0为已屏蔽，1为未屏蔽' AFTER `tutorship_need_iswally`;


/*
lyx
2018.06.19 end
*/


/*
lyx
2018.06.21 start
*/

ALTER TABLE `j_item`
ADD COLUMN `item_status`  tinyint(1) NOT NULL DEFAULT 1 COMMENT '0为已结束，1为进行中' AFTER `item_fourthmarks`;

/*
lyx
2018.06.21 end
*/

ALTER TABLE `newworld`.`u_concerns_group`
ADD COLUMN `concerns_group_uid` bigint(20) UNSIGNED NOT NULL COMMENT '创建分组的用户id' AFTER `concerns_group_name`;



CREATE TABLE IF NOT EXISTS `s_search_mark`(
	`mark_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT
	,`mark_type_id` SMALLINT UNSIGNED NOT NULL COMMENT '搜索标识类型ID'
	,`mark_pid` BIGINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '搜索标识父ID'
	,`mark_name` VARCHAR(255) NOT NULL COMMENT '标识名'
	,`mark_createtime` datetime NOT NULL COMMENT '创建时间'
	,`mark_sort` SMALLINT NOT NULL DEFAULT 0 COMMENT '排序'
	,PRIMARY KEY(`mark_id`)
	,INDEX `idx_search` (`mark_pid`,`mark_sort`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='搜索标识表';

CREATE TABLE IF NOT EXISTS `s_search_mark_type`(
	`mark_type_id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT
	,`mark_type_mid` SMALLINT UNSIGNED NOT NULL COMMENT '模型ID 1：兴趣 2：学习 3：工作 4：生活'
	,`mark_type_tid` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '类型ID 0：无 1：【工作=普通群，生活=群】 2：【工作=社交群，生活=二手市场】 3：企业家'
	,`mark_type_name` VARCHAR(90) NOT NULL COMMENT '标识名'
	,`mark_type_createtime` datetime NOT NULL COMMENT '创建时间'
	,`mark_type_sort` SMALLINT NOT NULL DEFAULT 0 COMMENT '排序'
	,`mark_type_show` TINYINT UNSIGNED NOT NULL DEFAULT 1 COMMENT '是否显示 1：显示 0 不显示'
	,PRIMARY KEY(`mark_type_id`)
	,INDEX `idx_search` (`mark_type_mid`,`mark_type_tid`,`mark_type_sort`,`mark_type_show`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='搜索标识类型表';


/*
lyx
2018.06.25 start
*/

ALTER TABLE `u_message`
MODIFY COLUMN `message_sendtime`  datetime NOT NULL COMMENT '信息发送时间' AFTER `message_content`,
MODIFY COLUMN `message_delivertime`  datetime NOT NULL COMMENT '信息送达时间' AFTER `message_sendtime`;

ALTER TABLE `l_commodity`
MODIFY COLUMN `commodity_status`  int(10) NOT NULL DEFAULT 1 COMMENT '状态，0为已删除，1为正常，2为已完成,3为已下架' AFTER `commodity_explain`;

ALTER TABLE `l_commodity`
ADD COLUMN `commodity_views`  bigint(20) NOT NULL DEFAULT 0 COMMENT '浏览量' AFTER `commodity_fifthmark`;



/*
lyx
2018.06.25 end
*/