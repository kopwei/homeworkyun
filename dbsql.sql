
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL auto_increment,
  `md5_id` varchar(200) NOT NULL,
  `user_name` varchar(200) collate utf8_general_ci NOT NULL default '',
  `pwd` varchar(220) collate utf8_general_ci NOT NULL default '',
  `gender` smallint NOT NULL,
  `ckey` varchar(220) collate utf8_general_ci NOT NULL default '',
  `ctime` varchar(220) collate utf8_general_ci NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM 