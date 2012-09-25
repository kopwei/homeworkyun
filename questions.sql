CREATE TABLE IF NOT EXISTS `single_selective_q` (
	`id` bigint(20) NOT NULL auto_increment,
	`title` varchar(200) NOT NULL,
	`op1` varchar(200) NOT NULL,
	`op2` varchar(200) NOT NULL,
	`op3` varchar(200) ,
	`op4` varchar(200) , 
	PRIMARY KEY(`id`)
) ;

insert into `single_selective_q` VALUES(1, '您觉得这个网站做的如何', '好', '很好', '非常好', '好的不得了');
insert into `single_selective_q` VALUES(2, '你觉得你自己做的出这样的网站吗', '做不来', '肯定做不来', '下辈子也做不来', '大哥我给您跪了');
insert into `single_selective_q` VALUES(3, '你觉得我这个作业能拿多少分', '100', '200', '满分中的满分', NULL);
insert into `single_selective_q` VALUES(4, '你觉得今年工资会涨多少', '10-50', '50-100', '100-150', '不倒扣就行');

CREATE TABLE IF NOT EXISTS `multi_selective_q` (
	`id` bigint(20) NOT NULL auto_increment,
	`title` varchar(200) NOT NULL,
	`op1` varchar(200) NOT NULL,
	`op2` varchar(200) NOT NULL,
	`op3` varchar(200) ,
	`op4` varchar(200) , 
	PRIMARY KEY(`id`)
) ;	
insert into `multi_selective_q` VALUES(1,'下面哪个设计模式你不会', 'Singleton', 'Bridge', 'Facade', 'Composite');
insert into `multi_selective_q` VALUES(2,'你吃过下面那些', '油条', '小笼包', '热干面', '刀削面');
insert into `multi_selective_q` VALUES(3,'你去过哪些城市', '北京', '自己家', '纽约', '香港');
insert into `multi_selective_q` VALUES(4,'你听说过以下哪几个演员', '陈道明', '小沈阳', '赵丽蓉', '温家Bao');


CREATE TABLE IF NOT EXISTS `open_q` (
	`id` bigint(20) NOT NULL auto_increment,
	`title` varchar(200) NOT NULL,
	PRIMARY KEY(`id`)
);

INSERT INTO `open_q` VALUES(1, '你觉得这个卷子难吗，如果难请说出难点，否则请说出为什么不难。');
INSERT INTO `open_q` VALUES(2, '你听说过JS框架么？请说出至少5个流行框架的名字');
INSERT INTO `open_q` VALUES(3, '你觉得最好吃的东西是啥');
INSERT INTO `open_q` VALUES(4, '请简述钓鱼岛争端的由来');



CREATE TABLE IF NOT EXISTS `number_q` (
	`id` bigint(20)	NOT	NULL auto_increment,
	`title` varchar(200) NOT NULL,
	`num1` bigint(20) NOT NULL,
	`num2` bigint(20) NOT NULL,
	`num3` bigint(20) NOT NULL,
	`num4` bigint(20) NOT NULL,
	PRIMARY KEY(`id`)
);

INSERT INTO `number_q` VALUES(1, '请根据前4个数字的规律，填出第五个数字', 2, 4, 6, 8);
INSERT INTO `number_q` VALUES(2, '请根据前4个数字的规律，填出第五个数字', 1, 4, 9, 16);
INSERT INTO `number_q` VALUES(3, '请根据前4个数字的规律，填出第五个数字', 1, 1, 2, 3);
INSERT INTO `number_q` VALUES(4, '请根据前4个数字的规律，填出第五个数字', 5, 10, 15, 20);

CREATE TABLE IF NOT EXISTS `survey_paper` (
	`id` bigint(20)	NOT	NULL auto_increment,
	`author_id` bigint(20) NOT NULL,
	`title`	varchar(200) NOT NULL,
	`selective_q1_id` bigint(20) NOT NULL,
	`selective_q2_id` bigint(20) NOT NULL,
	`selective_q3_id` bigint(20) NOT NULL,
	`open_q1_id`	bigint(20) NOT NULL,
	`num_q1_id` bigint(20) NOT NULL,
	PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `answer_paper` (
	`id` bigint(20)	NOT NULL auto_increment,
	`user_id` bigint(20) NOT NULL,
	`user_ip` varchar(20) NOT NULL,
	`answer_time_start` bigint(20) NOT NULL,
	`answer_time_end` bigint(20) NOT NULL,
	`select_q1_answer_id` bigint(20) NOT NULL,
	`select_q2_answer_id` bigint(20) NOT NULL,
	`select_q3_answer_id` bigint(20) NOT NULL,
	`open_q1_answer` varchar(500) NOT NULL,
	`num_q1_answer` bigint(20) NOT NULL,
	PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `selective_q_answer` (
	`id` bigint(20)	NOT NULL auto_increment,
	`select_q_id` bigint(20) NOT NULL,
	`answer_q1` tinyint(4) NOT NULL default 0,
	`answer_q2` tinyint(4) NOT NULL default 0,
	`answer_q3` tinyint(4) NOT NULL default 0,
	`answer_q4` tinyint(4) NOT NULL default 0,
	PRIMARY KEY(`id`)
);