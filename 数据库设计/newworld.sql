
/*
lyx
2018.06.10
*/
ALTER TABLE `u_note_comment`
ADD COLUMN `note_comment_isreply`  smallint(3) NOT NULL DEFAULT 0 COMMENT '�Ƿ�ظ���0Ϊ��1Ϊ��' AFTER `note_comment_zaner`;

ALTER TABLE `u_note_vi`
MODIFY COLUMN `note_vi_id`  bigint(20) NOT NULL AUTO_INCREMENT COMMENT '���ӵ���ƵͼƬ������id' FIRST ;


ALTER TABLE `u_note_vi`
ADD COLUMN `note_vi_type`  smallint(3) NULL COMMENT '�ļ����ͣ�1ΪͼƬ��2Ϊ��Ƶ' AFTER `note_vi_url`;

ALTER TABLE `u_question_vi`
ADD COLUMN `question_vi_type`  smallint(3) NULL COMMENT '�ļ�����,1ΪͼƬ��2Ϊ��Ƶ' AFTER `question_vi_url`;
ALTER TABLE `newworld`.`u_firends`
ADD COLUMN `firends_mark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '��ע��' AFTER `firends_createtime`;

ALTER TABLE `newworld`.`u_message`
ADD COLUMN `message_type` tinyint UNSIGNED NOT NULL  COMMENT '��Ϣ���� 0��ϵͳ��ʾ 1����������' AFTER `message_isread`;

ALTER TABLE `newworld`.`u_message` 
MODIFY COLUMN `message_sendtime` datetime(0) NOT NULL COMMENT '��Ϣ����ʱ��' AFTER `message_content`,
MODIFY COLUMN `message_delivertime` datetime(0) NOT NULL COMMENT '��Ϣ�ʹ�ʱ��' AFTER `message_sendtime`;

/*
lyx
2018.06.13 start
*/

ALTER TABLE `u_crowd`
ADD COLUMN `crowd_scool`  varchar(255) NULL COMMENT '��ҵԺУ' AFTER `crowd_icon`;

ALTER TABLE `u_crowd`
ADD COLUMN `crowd_scooltime`  varchar(255) NULL COMMENT '��ҵʱ��' AFTER `crowd_scool`;

ALTER TABLE `u_crowd`
ADD COLUMN `crowd_profession`  varchar(255) NULL COMMENT 'ְҵ��λ' AFTER `crowd_scooltime`;

ALTER TABLE `u_crowd`
ADD COLUMN `crowd_company`  varchar(255) NULL COMMENT '��ְ��˾' AFTER `crowd_profession`;

ALTER TABLE `u_crowd`
ADD COLUMN `crowd_help`  text NULL COMMENT '�ܹ��ṩ�İ���' AFTER `crowd_company`;

/*
lyx
2018.06.13 end
*/


/*
lyx
2018.06.15 start
*/

ALTER TABLE `u_note`
ADD COLUMN `note_haveanswer`  smallint(3) NOT NULL DEFAULT 0 COMMENT '0Ϊ��ûѡ��𰸣�1Ϊѡ�����' AFTER `note_reward`;

/*
lyx
2018.06.15 end
*/


