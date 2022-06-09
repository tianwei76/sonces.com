
DROP TABLE IF EXISTS `{dbprefix}var`;
CREATE TABLE IF NOT EXISTS `{dbprefix}var` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `name` varchar(100) NOT NULL COMMENT '变量描述名称',
  `cname` varchar(100) NOT NULL COMMENT '变量名称',
  `type` tinyint(2) NOT NULL COMMENT '变量类型',
  `hide` tinyint(1) unsigned NOT NULL COMMENT '隐藏',
  `value` text NOT NULL COMMENT '变量值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='自定义变量表';
