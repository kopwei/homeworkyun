CREATE TABLE `selective_q` (
	`id` bigint(20) NOT NULL auto_increment,
	`is_multiple` smallint NOT NULL,
	`title` varchar(200) NOT NULL,
	`op1` varchar(200) NOT NULL,
	`op2` varchar(200) NOT NULL,
	`op3` varchar(200) ,
	`op4` varchar(200) , 
	PRIMARY KEY(`id`)
) TYPE = MyISAM;

insert into `questions` VALUES(1, 1, '您觉得这个网站做的如何', '好', '很好', '非常好', '好的不得了');
insert into `questions` VALUES(2, 1, '你觉得你自己做的出这样的吗', '做不来', '肯定做不来', '下辈子也做不来', '大哥我给您跪了');
insert into `questions` VALUES(3, 1, '你觉得这个作业能拿多少分', '100', '200', '满分中的满分', NULL);
