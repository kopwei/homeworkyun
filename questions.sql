CREATE TABLE `questions` (
	`id` bigint(20) NOT NULL auto_increment,
	`title` varchar(200) NOT NULL,
	`op1` varchar(200) NOT NULL,
	`op2` varchar(200) NOT NULL,
	`op3` varchar(200) ,
	`op4` varchar(200) ,
	`op1_sum` bigint(20) NOT NULL,
	`op2_sum` bigint(20) NOT NULL,
	`op3_sum` bigint(20), 
	`op4_sum` bigint(20),
	PRIMARY KEY(`id`)
) TYPE = MyISAM;

insert into `questions` VALUES(1, '您觉得这个网站做的如何', '好', '很好', '非常好', '好的不得了', 0 ,0 ,0 ,0);
insert into `questions` VALUES(2, '你觉得你自己做的出这样的吗', '做不来', '肯定做不来', '下辈子也做不来', '大哥我给您跪了', 0 ,0 ,0 ,0);
insert into `questions` VALUES(3, '你觉得这个作业能拿多少分', '100', '200', '满分中的满分', NULL, 0 ,0 ,0 ,NULL);
insert into `questions` VALUES(4, '您的性别', '男', '女', '未知', NULL, 0 ,0 ,0 ,NULL);