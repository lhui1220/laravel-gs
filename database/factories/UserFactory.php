<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.

Create Table: CREATE TABLE `dating_tmp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL COMMENT '姓名',
  `cardNo` varchar(60) NOT NULL DEFAULT '' COMMENT '会员号',
  `descriot` varchar(255) NOT NULL DEFAULT '',
  `ctftp` varchar(20) NOT NULL COMMENT '证件类型,',
  `ctfid` varchar(128) NOT NULL COMMENT '证件号',
  `gender` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '性别,0:未知,1:男,2:女',
  `birthday` date DEFAULT NULL COMMENT '生日',
  `version` datetime DEFAULT NULL COMMENT '约炮时间',
  `address` varchar(255) NOT NULL DEFAULT '',
  `zip` varchar(40) NOT NULL DEFAULT '',
  `dirty` varchar(40) NOT NULL DEFAULT '',
  `district1` varchar(128) NOT NULL DEFAULT '',
  `district2` varchar(128) NOT NULL DEFAULT '',
  `district3` varchar(128) NOT NULL DEFAULT '',
  `district4` varchar(128) NOT NULL DEFAULT '',
  `district5` varchar(128) NOT NULL DEFAULT '',
  `district6` varchar(128) NOT NULL DEFAULT '',
  `firstnm` varchar(40) NOT NULL DEFAULT '',
  `lastnm` varchar(40) NOT NULL DEFAULT '',
  `duty` varchar(60) NOT NULL DEFAULT '',
  `mobile` varchar(128) NOT NULL DEFAULT '',
  `tel` varchar(128) NOT NULL DEFAULT '',
  `fax` varchar(128) NOT NULL DEFAULT '',
  `email` varchar(128) NOT NULL DEFAULT '',
  `nation` varchar(60) NOT NULL DEFAULT '',
  `taste` varchar(128) NOT NULL DEFAULT '',
  `education` varchar(128) NOT NULL DEFAULT '',
  `company` varchar(128) NOT NULL DEFAULT '',
  `ctel` varchar(128) NOT NULL DEFAULT '',
  `caddress` varchar(255) NOT NULL DEFAULT '',
  `czip` varchar(60) NOT NULL DEFAULT '',
  `family` char(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_gender_birthday` (`gender`,`birthday`) USING BTREE,
  KEY `idx_name` (`name`) USING BTREE,
  KEY `idx_identify` (`ctftp`,`ctfid`) USING BTREE,
  KEY `idx_address` (`address`) USING BTREE,
  KEY `idx_mobile` (`mobile`) USING BTREE,
  KEY `idx_birthday` (`birthday`) USING BTREE,
  KEY `idx_version` (`version`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7001 DEFAULT CHARSET=utf8

|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
