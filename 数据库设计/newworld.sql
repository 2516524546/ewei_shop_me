
/*
lyx
2018.06.10
*/
ALTER TABLE `u_note_comment`
ADD COLUMN `note_comment_isreply`  smallint(3) NOT NULL DEFAULT 0 COMMENT '是否回复，0为否，1为是' AFTER `note_comment_zaner`;

ALTER TABLE `u_note_vi`
MODIFY COLUMN `note_vi_id`  bigint(20) NOT NULL AUTO_INCREMENT COMMENT '帖子的视频图片表自增id' FIRST ;

ALTER TABLE `newworld`.`u_firends`
ADD COLUMN `firends_mark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '备注名' AFTER `firends_createtime`;

ALTER TABLE `newworld`.`u_message`
ADD COLUMN `message_type` tinyint UNSIGNED NOT NULL  COMMENT '信息类型 0：系统提示 1：好友申请' AFTER `message_isread`;

ALTER TABLE `newworld`.`u_message` 
MODIFY COLUMN `message_sendtime` datetime(0) NOT NULL COMMENT '信息发送时间' AFTER `message_content`,
MODIFY COLUMN `message_delivertime` datetime(0) NOT NULL COMMENT '信息送达时间' AFTER `message_sendtime`;
