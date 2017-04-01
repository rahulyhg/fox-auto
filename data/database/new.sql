CREATE TABLE `orders` (
`id`  varchar(30) NOT NULL ,
`name`  varchar(255) NOT NULL COMMENT '订单号' ,
`created_at`  datetime NOT NULL ,
`created_by_id`  varchar(24) NULL ,
`modified_at`  datetime NULL ,
`modified_by_id`  varchar(24) NULL ,
`assigned_user_id`  varchar(24) NOT NULL COMMENT '订单创建者，既买流量者' ,
`buyer_mobile`  bigint(13) UNSIGNED NOT NULL COMMENT '购买者手机号' ,
`ll_package`  varchar(24) NULL COMMENT '购买的流量包' ,
`money`  int(11) UNSIGNED NOT NULL COMMENT '流量包金额，单位厘' ,
`is_paid`  tinyint(1) NOT NULL DEFAULT 0 COMMENT '0未付款，1已付款' ,
`pay_time`  datetime NULL COMMENT '付款时间' ,
`seller_id`  varchar(24) NULL COMMENT '流量出售者id' ,
`seller_mobile`  bigint(13) NULL ,
`finished_time`  datetime NULL COMMENT '订单完成时间' ,
`status`  tinyint(1) NOT NULL DEFAULT 0 COMMENT '0未支付，1已支付待充值，2已充值，3未支付取消订单, 4无投诉， 5有投诉取消订单， 6有投诉驳回投诉， 7其他原因取消' ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
COMMENT='订单表'
CHECKSUM=0
DELAY_KEY_WRITE=0
;


ALTER TABLE `orders`
ADD COLUMN `deleted`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 AFTER `status`;



ALTER TABLE `account`
DROP COLUMN `website`,
DROP COLUMN `billing_address_street`,
DROP COLUMN `billing_address_city`,
DROP COLUMN `billing_address_state`,
DROP COLUMN `billing_address_country`,
DROP COLUMN `billing_address_postal_code`,
DROP COLUMN `shipping_address_street`,
DROP COLUMN `shipping_address_city`,
DROP COLUMN `shipping_address_state`,
DROP COLUMN `shipping_address_country`,
DROP COLUMN `shipping_address_postal_code`,
DROP COLUMN `campaign_id`,
ADD COLUMN `open_id`  varchar(255) NULL COMMENT '微信open_id' AFTER `type`,
ADD COLUMN `balances`  int(11) NOT NULL DEFAULT 0 AFTER `open_id`,
ADD COLUMN `blocked_balances`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '冻结余额，不能取现' AFTER `balances`,
ADD COLUMN `parent_id`  varchar(24) NULL AFTER `blocked_balances`;

CREATE TABLE `set_meal` (
`id`  varchar(24) NOT NULL ,
`name`  varchar(50) NOT NULL ,
`deleted`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 ,
`flow`  int(11) NOT NULL DEFAULT 0 COMMENT '流量包单位kb' ,
`selling_price`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '售价（下单），单位厘' ,
`order_price`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '抢单价，单位厘' ,
`created_at`  datetime NULL ,
`modified_at`  datetime NULL ,
`created_by_id`  varchar(24) ,
`modified_by_id`  varchar(24) ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
CHECKSUM=0
DELAY_KEY_WRITE=0
;



ALTER TABLE `orders`
DROP COLUMN `assigned_user_id`,
DROP COLUMN `buyer_mobile`,
CHANGE COLUMN `ll_package` `set_meal_id`  varchar(24) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT '购买的流量包id' AFTER `modified_by_id`,
ADD COLUMN `flow`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '流量，单位mb' AFTER `set_meal_id`,
ADD COLUMN `from`  varchar(255) NULL COMMENT '来源' AFTER `deleted`;


ALTER TABLE `orders`
DROP COLUMN `assigned_user_id`,
DROP COLUMN `buyer_mobile`,
CHANGE COLUMN `ll_package` `set_meal_id`  varchar(24) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT '购买的流量包id' AFTER `modified_by_id`,
MODIFY COLUMN `status`  tinyint(1) NOT NULL DEFAULT 0 COMMENT '0未支付，1已支付待充值，2已充值，3未支付取消订单, 4无投诉， 5有投诉取消订单， 6有投诉驳回投诉， 7其他原因取消' AFTER `finished_time`,
ADD COLUMN `flow`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '流量，单位mb' AFTER `set_meal_id`,
ADD COLUMN `from`  varchar(255) NULL COMMENT '来源' AFTER `deleted`;

ALTER TABLE `account`
ADD COLUMN `avatar`  varchar(255) NULL COMMENT '头像网址' AFTER `open_id`,
ADD UNIQUE INDEX (`open_id`) USING BTREE ;


ALTER TABLE `account`
MODIFY COLUMN `parent_id`  varchar(24) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 0 AFTER `blocked_balances`;


CREATE TABLE `set_meal` (
  `id` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `flow` int(11) NOT NULL DEFAULT '0' COMMENT '流量包单位mb',
  `selling_price` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '售价（下单），单位厘',
  `order_price` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '抢单价，单位厘',
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `created_by_id` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_by_id` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `orders`
DROP COLUMN `is_paid`,
MODIFY COLUMN `status`  tinyint(1) NOT NULL DEFAULT 0 COMMENT '0未充值，1已充值，2已充值被投诉，3订单超时取消，4主动取消，5被投诉取消， 6已完成' AFTER `finished_time`;

CREATE TABLE `encashment` (
`id`  varchar(24) NOT NULL ,
`money`  int(11) NOT NULL DEFAULT 1000 COMMENT '提现金额单位厘' ,
`created_at`  datetime NOT NULL ,
`account_id`  varchar(24) NOT NULL COMMENT '提现的用户id' ,
`status`  tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '（预留）1审核中， 2审核不通过，3审核通过' ,
`finished_time`  datetime COMMENT '提现时间' ,
`deleted`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
;


ALTER TABLE `orders`
ADD COLUMN `buyer_mobile`  bigint(13) NOT NULL DEFAULT 0 COMMENT '购买者手机号' AFTER `buy_order_no`,
ADD COLUMN `flow_type`  tinyint(1) NOT NULL DEFAULT 1 COMMENT '1移动，2电信，3联通' AFTER `buyer_mobile`,
ADD COLUMN `flow_adress`  tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0全国' AFTER `flow_type`;

CREATE TABLE `bill` (
`id`  varchar(24) NOT NULL ,
`money`  int(11) NOT NULL DEFAULT 0 COMMENT '收支金额，单位厘' ,
`from`  tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '来源，1转移流量，2粉丝收入，3购买流量' ,
`created_at`  datetime NOT NULL ,
`account_id`  varchar(24) NOT NULL COMMENT '所属人' ,
`deleted`  tinyint(1) UNSIGNED NOT NULL DEFAULT 1 ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
COMMENT='收入支出账单表'
CHECKSUM=0
DELAY_KEY_WRITE=0
;


ALTER TABLE `buy_orders`
MODIFY COLUMN `id`  int(11) UNSIGNED NOT NULL FIRST ,
MODIFY COLUMN `status`  tinyint(2) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0闲置，1充值中，2订单取消，3订单投诉中，4订单完成，5订单被投诉后取消' AFTER `buyer_mobile`,
ENGINE=InnoDB;

ALTER TABLE `set_meal`
ADD COLUMN `province`  varchar(30) NOT NULL DEFAULT 0 COMMENT '0全国' AFTER `order_price`;


ALTER TABLE `set_meal`
DROP COLUMN `created_by_id`,
DROP COLUMN `modified_by_id`,
CHANGE COLUMN `modified_at` `created_by_id`  varchar(24) NOT NULL AFTER `created_at`,
ADD COLUMN `province`  varchar(30) NOT NULL DEFAULT 0 COMMENT '0全国' AFTER `order_price`,
ADD COLUMN `status`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '策略是否生效，1生效，0不生效' AFTER `created_by_id`,
ADD COLUMN `audit_by_id`  varchar(24) NOT NULL DEFAULT '' COMMENT '审核人' AFTER `status`,
ADD COLUMN `desc`  varchar(255) NULL COMMENT '备注' AFTER `audit_by_id`;


ALTER TABLE `set_meal`
ADD COLUMN `type`  tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1电信，2移动，3联通' AFTER `desc`;
ALTER TABLE `set_meal`
ADD COLUMN `audit_at`  datetime NULL COMMENT '审核时间' AFTER `type`;

CREATE TABLE `area` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

ALTER TABLE `area`
ADD COLUMN `deleted`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 AFTER `name`;

ALTER TABLE `set_meal`
CHANGE COLUMN `province` `area_id`  int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0全国' AFTER `order_price`;


CREATE TABLE `tactics` (
`id`  varchar(24) NOT NULL ,
`name`  tinyint(1) UNSIGNED NOT NULL DEFAULT 1 ,
`v1`  varchar(255) NOT NULL ,
`v2`  varchar(255) NOT NULL ,
`v3`  varchar(255) NOT NULL ,
`v4`  varchar(255) NOT NULL ,
`status`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0未审核，1通过，2不通过' ,
`created_at`  datetime NOT NULL ,
`created_by_id`  varchar(24) NOT NULL ,
`audit_at`  datetime NULL ,
`audit_by_id`  varchar(24) NOT NULL ,
`desc`  varchar(255) NOT NULL ,
PRIMARY KEY (`id`),
INDEX (`name`) USING BTREE
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
COMMENT='策略设置表'
CHECKSUM=0
DELAY_KEY_WRITE=0
;

ALTER TABLE `tactics`
MODIFY COLUMN `name`  tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1粉丝分成，2用户异常投诉时段，3订单导入时间间隔，4抢单过期时间，5订单导入数量限制' AFTER `id`,
ADD COLUMN `deleted`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 AFTER `desc`;

CREATE TABLE `orders_limit` (
`id`  varchar(24) NOT NULL ,
`flow`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0.500M, 1.1G, 2.2G, 3.3G' ,
`area_id`  int(11) UNSIGNED NOT NULL DEFAULT 0 ,
`type`  tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1电信，2移动，3联通' ,
`num`  smallint(8) NOT NULL DEFAULT 0 COMMENT '数量，-1为不限制' ,
`deleted`  tinyint(1) NOT NULL ,
`created_by_id`  varchar(24) NOT NULL ,
`created_at`  datetime NOT NULL ,
`audit_at`  datetime NOT NULL ,
`audit_by_id`  varchar(24) NOT NULL ,
`status`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0未审核，1通过，2拒绝' ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
COMMENT='导入订单数量限制表'
CHECKSUM=0
DELAY_KEY_WRITE=0
;

ALTER TABLE `orders_limit`
ADD COLUMN `desc`  varchar(255) NOT NULL AFTER `status`;


CREATE TABLE `account_ext` (
`id`  varchar(24) NOT NULL COMMENT 'account id' ,
`qr_url`  varchar(255) NOT NULL COMMENT '二维码url' ,
`qr_created_at`  datetime NOT NULL COMMENT '二维码生成时间' ,
`qr_ticket`  varchar(255) NOT NULL COMMENT '二维码生成ticket' ,
`deleted`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 ,
`scene_id`  varchar(32) NOT NULL COMMENT '生成二维码时的唯一码' ,
PRIMARY KEY (`id`),
UNIQUE INDEX (`scene_id`) USING BTREE
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
COMMENT='客户扩展表'
;

ALTER TABLE `encashment`
ADD COLUMN `audit_at`  datetime NOT NULL AFTER `deleted`,
ADD COLUMN `audit_by_id`  varchar(24) NOT NULL AFTER `audit_at`,
ADD COLUMN `desc`  varchar(255) NOT NULL AFTER `audit_by_id`,
MODIFY COLUMN `status`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '（预留）0审核中， 2审核不通过，1审核通过' AFTER `account_id`;


ALTER TABLE `set_meal`
DROP COLUMN `name`;

ALTER TABLE `orders`
MODIFY COLUMN `status`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0刚抢单未提交，1流量交易提交，2取消订单，3审核不通过可再次提交' AFTER `finished_time`,
CHANGE COLUMN `flow_adress` `area_id`  tinyint(3) UNSIGNED NOT NULL DEFAULT 100 COMMENT '100全国' AFTER `flow_type`,
ADD COLUMN `parent_income`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上线获得的收入，单位厘' AFTER `area_id`,
ADD COLUMN `audit_opinion`  varchar(255) NOT NULL AFTER `parent_income`,
ADD COLUMN `audit_status`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0刚提交还未审核，1审核通过，2审核不通过' AFTER `audit_opinion`,
ADD COLUMN `desc`  varchar(255) NOT NULL COMMENT '备注' AFTER `audit_status`,
ADD COLUMN `audit_at`  datetime NOT NULL AFTER `desc`,
ADD COLUMN `audit_by_id`  varchar(24) NOT NULL AFTER `audit_at`,
ADD COLUMN `complaint_status`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0未被投诉，1被投诉并核实投诉通过，2被投诉核实投诉不通过' AFTER `audit_by_id`;



ALTER TABLE `buy_orders`
MODIFY COLUMN `status`  tinyint(2) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0闲置，1充值中（抢单中），2完成订单转移（卖家反馈），3转移超时，4完成审核' AFTER `buyer_mobile`,
ADD COLUMN `flow_type`  tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1电信，2移动，3联通' AFTER `from`,
ADD COLUMN `area_id`  tinyint(4) NOT NULL COMMENT '区域id' AFTER `flow_type`,
ADD COLUMN `complaint_status`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0无投诉，1收到投诉，2核实投诉虚假，3核实投诉真实' AFTER `area_id`,
ADD COLUMN `rollback_status`  tinyint(1) NOT NULL DEFAULT 0 COMMENT '0还未提交退回申请，1退回申请中，2收到退回申请结果' AFTER `complaint_status`;


ALTER TABLE `orders`
MODIFY COLUMN `flow`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0.500M, 1.1G, 2.2G, 3.3G' AFTER `set_meal_id`,
MODIFY COLUMN `desc`  varchar(255) CHARACTER SET utf8mb4 NOT NULL COMMENT '备注' AFTER `audit_status`;

ALTER TABLE `buy_orders`
MODIFY COLUMN `flow`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0.500M, 1.1G, 2.2G, 3.3G' AFTER `money`,
ADD COLUMN `is_paid`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0未到账，1已到账' AFTER `complaint_status`;

ALTER TABLE `orders`
ENGINE=InnoDB;

ALTER TABLE `account`
ADD COLUMN `mobile`  bigint(13) UNSIGNED NOT NULL DEFAULT 0 AFTER `assigned_user_id`;

CREATE TABLE `orders_img` (
`orders_id`  varchar(24) NOT NULL ,
`img_id`  varchar(24) NOT NULL ,
UNIQUE INDEX (`orders_id`, `img_id`) USING BTREE
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
;

ALTER TABLE `orders`
ADD UNIQUE INDEX (`name`) USING BTREE ;

CREATE TABLE `reason` (
`id`  varchar(24) NOT NULL ,
`name`  varchar(255) NOT NULL ,
`deleted`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 ,
`status`  tinyint(1) NOT NULL DEFAULT 1 COMMENT '1通过理由，2不通过理由' ,
`type`  enum('Tactics','SetMeal','OrdersLimit','Orders') NOT NULL DEFAULT 'Orders' ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
CHECKSUM=0
DELAY_KEY_WRITE=0
;

ALTER TABLE `account`
ADD COLUMN `full_name`  varchar(10) NOT NULL COMMENT '姓名' AFTER `mobile`,
ADD COLUMN `wechat_no`  varchar(20) NOT NULL COMMENT '微信号' AFTER `full_name`,
ADD COLUMN `sex`  tinyint(1) NOT NULL DEFAULT 0 COMMENT '0未知，1男，2女' AFTER `wechat_no`,
ADD COLUMN `zfb`  varchar(20) NOT NULL COMMENT '支付宝账号' AFTER `sex`;


ALTER TABLE `account_ext`
ADD COLUMN `area_id`  tinyint(4) UNSIGNED NOT NULL DEFAULT 0 COMMENT '归属地信息' AFTER `scene_id`,
ADD COLUMN `operator_type`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '运营商类型，0未知，1电信，2移动，3联通' AFTER `area_id`;


ALTER TABLE `orders`
DROP COLUMN `audit_opinion`,
ADD COLUMN `reason_id`  varchar(24) NOT NULL DEFAULT '' COMMENT '审核理由id' AFTER `is_paid`;


ALTER TABLE `set_meal`
ADD COLUMN `reason_id`  varchar(24) NOT NULL DEFAULT '' COMMENT '审核理由' AFTER `audit_at`;

ALTER TABLE `orders_limit`
ADD COLUMN `reason_id`  varchar(24) NOT NULL DEFAULT '' COMMENT '审核理由' AFTER `desc`;

ALTER TABLE `tactics`
MODIFY COLUMN `audit_at`  datetime NOT NULL AFTER `created_by_id`,
ADD COLUMN `reason_id`  varchar(24) NOT NULL DEFAULT '' COMMENT '审核理由' AFTER `deleted`;

ALTER TABLE `account_ext`
DROP INDEX `scene_id`;


ALTER TABLE `buy_orders`
ADD COLUMN `is_paid`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0未付款，1已付款（未确认成功），3支付成功，4取消支付，5待结算状态，6支付失败' AFTER `rollback_status`,
ADD COLUMN `paid_at`  datetime NOT NULL COMMENT '付款时间' AFTER `is_paid`;

ALTER TABLE `buy_orders`
MODIFY COLUMN `set_meal_id`  varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `flow`,
MODIFY COLUMN `buyer_id`  varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '购买者id（预留）' AFTER `set_meal_id`,
MODIFY COLUMN `created_by_id`  varchar(24) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' AFTER `finished_time`,
MODIFY COLUMN `area_id`  tinyint(4) NOT NULL DEFAULT 0 COMMENT '区域id' AFTER `flow_type`,
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci;
ALTER TABLE `buy_orders`
MODIFY COLUMN `id`  varchar(24) NOT NULL FIRST ;

ALTER TABLE `buy_orders`
MODIFY COLUMN `buyer_mobile`  varchar(24) NOT NULL COMMENT '购买者手机号' AFTER `buyer_id`;

ALTER TABLE `buy_orders`
ADD COLUMN `pay_type`  tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1手动结算，2微信公众号支付' AFTER `paid_at`;

