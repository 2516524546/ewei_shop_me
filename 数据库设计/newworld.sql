
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
