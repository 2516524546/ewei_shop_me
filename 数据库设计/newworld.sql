
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


