
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
