/*
SQLyog Enterprise - MySQL GUI v7.02 
MySQL - 5.6.25 : Database - gym
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `attandence` */

DROP TABLE IF EXISTS `attandence`;

CREATE TABLE `attandence` (
  `attandence_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `attendance` varchar(60) DEFAULT 'A',
  `date` date DEFAULT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `inserted_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`attandence_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `attandence` */

insert  into `attandence`(`attandence_id`,`customer_id`,`attendance`,`date`,`is_del`,`status`,`inserted_on`,`updated_on`) values (1,1,'p','2016-03-16',0,1,'2016-03-16 09:15:27','0000-00-00 00:00:00'),(2,1,'P','2016-03-16',0,1,'2016-03-16 09:19:52','0000-00-00 00:00:00'),(3,2,'P','2016-03-19',0,1,'2016-03-19 08:21:53','0000-00-00 00:00:00'),(4,1,'A','2016-03-22',0,1,'2016-03-22 04:14:44','0000-00-00 00:00:00'),(5,2,'A','2016-03-22',0,1,'2016-03-22 04:16:02','0000-00-00 00:00:00'),(6,2,'P','2016-03-23',0,1,'2016-03-23 12:41:36','0000-00-00 00:00:00'),(7,3,'P','2016-04-09',0,1,'2016-04-09 08:03:31','0000-00-00 00:00:00'),(8,1,'P','2016-04-09',0,1,'2016-04-09 08:11:11','0000-00-00 00:00:00');

/*Table structure for table `country` */

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `iso_code_2` varchar(2) NOT NULL,
  `iso_code_3` varchar(3) NOT NULL,
  `address_format` text NOT NULL,
  `postcode_required` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM AUTO_INCREMENT=258 DEFAULT CHARSET=utf8;

/*Data for the table `country` */

insert  into `country`(`country_id`,`name`,`iso_code_2`,`iso_code_3`,`address_format`,`postcode_required`,`status`) values (1,'Afghanistan','AF','AFG','',0,1),(2,'Albania','AL','ALB','',0,1),(3,'Algeria','DZ','DZA','',0,1),(4,'American Samoa','AS','ASM','',0,1),(5,'Andorra','AD','AND','',0,1),(6,'Angola','AO','AGO','',0,1),(7,'Anguilla','AI','AIA','',0,1),(8,'Antarctica','AQ','ATA','',0,1),(9,'Antigua and Barbuda','AG','ATG','',0,1),(10,'Argentina','AR','ARG','',0,1),(11,'Armenia','AM','ARM','',0,1),(12,'Aruba','AW','ABW','',0,1),(13,'Australia','AU','AUS','',0,1),(14,'Austria','AT','AUT','',0,1),(15,'Azerbaijan','AZ','AZE','',0,1),(16,'Bahamas','BS','BHS','',0,1),(17,'Bahrain','BH','BHR','',0,1),(18,'Bangladesh','BD','BGD','',0,1),(19,'Barbados','BB','BRB','',0,1),(20,'Belarus','BY','BLR','',0,1),(21,'Belgium','BE','BEL','{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}',0,1),(22,'Belize','BZ','BLZ','',0,1),(23,'Benin','BJ','BEN','',0,1),(24,'Bermuda','BM','BMU','',0,1),(25,'Bhutan','BT','BTN','',0,1),(26,'Bolivia','BO','BOL','',0,1),(27,'Bosnia and Herzegovina','BA','BIH','',0,1),(28,'Botswana','BW','BWA','',0,1),(29,'Bouvet Island','BV','BVT','',0,1),(30,'Brazil','BR','BRA','',0,1),(31,'British Indian Ocean Territory','IO','IOT','',0,1),(32,'Brunei Darussalam','BN','BRN','',0,1),(33,'Bulgaria','BG','BGR','',0,1),(34,'Burkina Faso','BF','BFA','',0,1),(35,'Burundi','BI','BDI','',0,1),(36,'Cambodia','KH','KHM','',0,1),(37,'Cameroon','CM','CMR','',0,1),(38,'Canada','CA','CAN','',0,1),(39,'Cape Verde','CV','CPV','',0,1),(40,'Cayman Islands','KY','CYM','',0,1),(41,'Central African Republic','CF','CAF','',0,1),(42,'Chad','TD','TCD','',0,1),(43,'Chile','CL','CHL','',0,1),(44,'China','CN','CHN','',0,1),(45,'Christmas Island','CX','CXR','',0,1),(46,'Cocos (Keeling) Islands','CC','CCK','',0,1),(47,'Colombia','CO','COL','',0,1),(48,'Comoros','KM','COM','',0,1),(49,'Congo','CG','COG','',0,1),(50,'Cook Islands','CK','COK','',0,1),(51,'Costa Rica','CR','CRI','',0,1),(52,'Cote D\'Ivoire','CI','CIV','',0,1),(53,'Croatia','HR','HRV','',0,1),(54,'Cuba','CU','CUB','',0,1),(55,'Cyprus','CY','CYP','',0,1),(56,'Czech Republic','CZ','CZE','',0,1),(57,'Denmark','DK','DNK','',0,1),(58,'Djibouti','DJ','DJI','',0,1),(59,'Dominica','DM','DMA','',0,1),(60,'Dominican Republic','DO','DOM','',0,1),(61,'East Timor','TL','TLS','',0,1),(62,'Ecuador','EC','ECU','',0,1),(63,'Egypt','EG','EGY','',0,1),(64,'El Salvador','SV','SLV','',0,1),(65,'Equatorial Guinea','GQ','GNQ','',0,1),(66,'Eritrea','ER','ERI','',0,1),(67,'Estonia','EE','EST','',0,1),(68,'Ethiopia','ET','ETH','',0,1),(69,'Falkland Islands (Malvinas)','FK','FLK','',0,1),(70,'Faroe Islands','FO','FRO','',0,1),(71,'Fiji','FJ','FJI','',0,1),(72,'Finland','FI','FIN','',0,1),(74,'France, Metropolitan','FR','FRA','{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}',1,1),(75,'French Guiana','GF','GUF','',0,1),(76,'French Polynesia','PF','PYF','',0,1),(77,'French Southern Territories','TF','ATF','',0,1),(78,'Gabon','GA','GAB','',0,1),(79,'Gambia','GM','GMB','',0,1),(80,'Georgia','GE','GEO','',0,1),(81,'Germany','DE','DEU','{company}\r\n{firstname} {lastname}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}',1,1),(82,'Ghana','GH','GHA','',0,1),(83,'Gibraltar','GI','GIB','',0,1),(84,'Greece','GR','GRC','',0,1),(85,'Greenland','GL','GRL','',0,1),(86,'Grenada','GD','GRD','',0,1),(87,'Guadeloupe','GP','GLP','',0,1),(88,'Guam','GU','GUM','',0,1),(89,'Guatemala','GT','GTM','',0,1),(90,'Guinea','GN','GIN','',0,1),(91,'Guinea-Bissau','GW','GNB','',0,1),(92,'Guyana','GY','GUY','',0,1),(93,'Haiti','HT','HTI','',0,1),(94,'Heard and Mc Donald Islands','HM','HMD','',0,1),(95,'Honduras','HN','HND','',0,1),(96,'Hong Kong','HK','HKG','',0,1),(97,'Hungary','HU','HUN','',0,1),(98,'Iceland','IS','ISL','',0,1),(99,'India','IN','IND','',0,1),(100,'Indonesia','ID','IDN','',0,1),(101,'Iran (Islamic Republic of)','IR','IRN','',0,1),(102,'Iraq','IQ','IRQ','',0,1),(103,'Ireland','IE','IRL','',0,1),(104,'Israel','IL','ISR','',0,1),(105,'Italy','IT','ITA','',0,1),(106,'Jamaica','JM','JAM','',0,1),(107,'Japan','JP','JPN','',0,1),(108,'Jordan','JO','JOR','',0,1),(109,'Kazakhstan','KZ','KAZ','',0,1),(110,'Kenya','KE','KEN','',0,1),(111,'Kiribati','KI','KIR','',0,1),(112,'North Korea','KP','PRK','',0,1),(113,'Korea, Republic of','KR','KOR','',0,1),(114,'Kuwait','KW','KWT','',0,1),(115,'Kyrgyzstan','KG','KGZ','',0,1),(116,'Lao People\'s Democratic Republic','LA','LAO','',0,1),(117,'Latvia','LV','LVA','',0,1),(118,'Lebanon','LB','LBN','',0,1),(119,'Lesotho','LS','LSO','',0,1),(120,'Liberia','LR','LBR','',0,1),(121,'Libyan Arab Jamahiriya','LY','LBY','',0,1),(122,'Liechtenstein','LI','LIE','',0,1),(123,'Lithuania','LT','LTU','',0,1),(124,'Luxembourg','LU','LUX','',0,1),(125,'Macau','MO','MAC','',0,1),(126,'FYROM','MK','MKD','',0,1),(127,'Madagascar','MG','MDG','',0,1),(128,'Malawi','MW','MWI','',0,1),(129,'Malaysia','MY','MYS','',0,1),(130,'Maldives','MV','MDV','',0,1),(131,'Mali','ML','MLI','',0,1),(132,'Malta','MT','MLT','',0,1),(133,'Marshall Islands','MH','MHL','',0,1),(134,'Martinique','MQ','MTQ','',0,1),(135,'Mauritania','MR','MRT','',0,1),(136,'Mauritius','MU','MUS','',0,1),(137,'Mayotte','YT','MYT','',0,1),(138,'Mexico','MX','MEX','',0,1),(139,'Micronesia, Federated States of','FM','FSM','',0,1),(140,'Moldova, Republic of','MD','MDA','',0,1),(141,'Monaco','MC','MCO','',0,1),(142,'Mongolia','MN','MNG','',0,1),(143,'Montserrat','MS','MSR','',0,1),(144,'Morocco','MA','MAR','',0,1),(145,'Mozambique','MZ','MOZ','',0,1),(146,'Myanmar','MM','MMR','',0,1),(147,'Namibia','NA','NAM','',0,1),(148,'Nauru','NR','NRU','',0,1),(149,'Nepal','NP','NPL','',0,1),(150,'Netherlands','NL','NLD','',0,1),(151,'Netherlands Antilles','AN','ANT','',0,1),(152,'New Caledonia','NC','NCL','',0,1),(153,'New Zealand','NZ','NZL','',0,1),(154,'Nicaragua','NI','NIC','',0,1),(155,'Niger','NE','NER','',0,1),(156,'Nigeria','NG','NGA','',0,1),(157,'Niue','NU','NIU','',0,1),(158,'Norfolk Island','NF','NFK','',0,1),(159,'Northern Mariana Islands','MP','MNP','',0,1),(160,'Norway','NO','NOR','',0,1),(161,'Oman','OM','OMN','',0,1),(162,'Pakistan','PK','PAK','',0,1),(163,'Palau','PW','PLW','',0,1),(164,'Panama','PA','PAN','',0,1),(165,'Papua New Guinea','PG','PNG','',0,1),(166,'Paraguay','PY','PRY','',0,1),(167,'Peru','PE','PER','',0,1),(168,'Philippines','PH','PHL','',0,1),(169,'Pitcairn','PN','PCN','',0,1),(170,'Poland','PL','POL','',0,1),(171,'Portugal','PT','PRT','',0,1),(172,'Puerto Rico','PR','PRI','',0,1),(173,'Qatar','QA','QAT','',0,1),(174,'Reunion','RE','REU','',0,1),(175,'Romania','RO','ROM','',0,1),(176,'Russian Federation','RU','RUS','',0,1),(177,'Rwanda','RW','RWA','',0,1),(178,'Saint Kitts and Nevis','KN','KNA','',0,1),(179,'Saint Lucia','LC','LCA','',0,1),(180,'Saint Vincent and the Grenadines','VC','VCT','',0,1),(181,'Samoa','WS','WSM','',0,1),(182,'San Marino','SM','SMR','',0,1),(183,'Sao Tome and Principe','ST','STP','',0,1),(184,'Saudi Arabia','SA','SAU','',0,1),(185,'Senegal','SN','SEN','',0,1),(186,'Seychelles','SC','SYC','',0,1),(187,'Sierra Leone','SL','SLE','',0,1),(188,'Singapore','SG','SGP','',0,1),(189,'Slovak Republic','SK','SVK','{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{city} {postcode}\r\n{zone}\r\n{country}',0,1),(190,'Slovenia','SI','SVN','',0,1),(191,'Solomon Islands','SB','SLB','',0,1),(192,'Somalia','SO','SOM','',0,1),(193,'South Africa','ZA','ZAF','',0,1),(194,'South Georgia &amp; South Sandwich Islands','GS','SGS','',0,1),(195,'Spain','ES','ESP','',0,1),(196,'Sri Lanka','LK','LKA','',0,1),(197,'St. Helena','SH','SHN','',0,1),(198,'St. Pierre and Miquelon','PM','SPM','',0,1),(199,'Sudan','SD','SDN','',0,1),(200,'Suriname','SR','SUR','',0,1),(201,'Svalbard and Jan Mayen Islands','SJ','SJM','',0,1),(202,'Swaziland','SZ','SWZ','',0,1),(203,'Sweden','SE','SWE','{company}\r\n{firstname} {lastname}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}',1,1),(204,'Switzerland','CH','CHE','',0,1),(205,'Syrian Arab Republic','SY','SYR','',0,1),(206,'Taiwan','TW','TWN','',0,1),(207,'Tajikistan','TJ','TJK','',0,1),(208,'Tanzania, United Republic of','TZ','TZA','',0,1),(209,'Thailand','TH','THA','',0,1),(210,'Togo','TG','TGO','',0,1),(211,'Tokelau','TK','TKL','',0,1),(212,'Tonga','TO','TON','',0,1),(213,'Trinidad and Tobago','TT','TTO','',0,1),(214,'Tunisia','TN','TUN','',0,1),(215,'Turkey','TR','TUR','',0,1),(216,'Turkmenistan','TM','TKM','',0,1),(217,'Turks and Caicos Islands','TC','TCA','',0,1),(218,'Tuvalu','TV','TUV','',0,1),(219,'Uganda','UG','UGA','',0,1),(220,'Ukraine','UA','UKR','',0,1),(221,'United Arab Emirates','AE','ARE','',0,1),(222,'United Kingdom','GB','GBR','',1,1),(223,'United States','US','USA','{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{city}, {zone} {postcode}\r\n{country}',0,1),(224,'United States Minor Outlying Islands','UM','UMI','',0,1),(225,'Uruguay','UY','URY','',0,1),(226,'Uzbekistan','UZ','UZB','',0,1),(227,'Vanuatu','VU','VUT','',0,1),(228,'Vatican City State (Holy See)','VA','VAT','',0,1),(229,'Venezuela','VE','VEN','',0,1),(230,'Viet Nam','VN','VNM','',0,1),(231,'Virgin Islands (British)','VG','VGB','',0,1),(232,'Virgin Islands (U.S.)','VI','VIR','',0,1),(233,'Wallis and Futuna Islands','WF','WLF','',0,1),(234,'Western Sahara','EH','ESH','',0,1),(235,'Yemen','YE','YEM','',0,1),(237,'Democratic Republic of Congo','CD','COD','',0,1),(238,'Zambia','ZM','ZMB','',0,1),(239,'Zimbabwe','ZW','ZWE','',0,1),(242,'Montenegro','ME','MNE','',0,1),(243,'Serbia','RS','SRB','',0,1),(244,'Aaland Islands','AX','ALA','',0,1),(245,'Bonaire, Sint Eustatius and Saba','BQ','BES','',0,1),(246,'Curacao','CW','CUW','',0,1),(247,'Palestinian Territory, Occupied','PS','PSE','',0,1),(248,'South Sudan','SS','SSD','',0,1),(249,'St. Barthelemy','BL','BLM','',0,1),(250,'St. Martin (French part)','MF','MAF','',0,1),(251,'Canary Islands','IC','ICA','',0,1),(252,'Ascension Island (British)','AC','ASC','',0,1),(253,'Kosovo, Republic of','XK','UNK','',0,1),(254,'Isle of Man','IM','IMN','',0,1),(255,'Tristan da Cunha','TA','SHN','',0,1),(256,'Guernsey','GG','GGY','',0,1),(257,'Jersey','JE','JEY','',0,1);

/*Table structure for table `fee_config` */

DROP TABLE IF EXISTS `fee_config`;

CREATE TABLE `fee_config` (
  `fee_config_id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_name` varchar(255) DEFAULT NULL,
  `registration_amount` double(11,2) NOT NULL,
  `monthly_name` varchar(255) DEFAULT NULL,
  `monthly_amount` double(11,2) DEFAULT NULL,
  `is_del` tinyint(11) NOT NULL,
  `status` tinyint(11) NOT NULL,
  `inserted_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `inserted_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`fee_config_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `fee_config` */

insert  into `fee_config`(`fee_config_id`,`registration_name`,`registration_amount`,`monthly_name`,`monthly_amount`,`is_del`,`status`,`inserted_on`,`updated_on`,`inserted_by`,`updated_by`) values (1,'Registartion Fee',1000.00,'Monthly Fee',500.00,0,0,'2016-03-14 07:39:58','2016-05-01 07:59:29',NULL,NULL);

/*Table structure for table `fee_month` */

DROP TABLE IF EXISTS `fee_month`;

CREATE TABLE `fee_month` (
  `fee_month_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `amount` decimal(13,2) NOT NULL,
  `fee_status` varchar(255) DEFAULT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `inserted_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `inserted_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`fee_month_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `fee_month` */

insert  into `fee_month`(`fee_month_id`,`customer_id`,`date`,`amount`,`fee_status`,`is_del`,`status`,`inserted_on`,`updated_on`,`inserted_by`,`updated_by`) values (1,1,'2016-04-18','500.00','paid',0,1,'2016-04-18 06:42:56','0000-00-00 00:00:00',NULL,NULL),(2,3,'2016-04-18','500.00','paid',0,1,'2016-04-18 06:43:40','0000-00-00 00:00:00',NULL,NULL),(4,1,'2016-04-24','500.00','Paid',0,1,'2016-04-24 09:49:32','0000-00-00 00:00:00',NULL,NULL);

/*Table structure for table `globle_option` */

DROP TABLE IF EXISTS `globle_option`;

CREATE TABLE `globle_option` (
  `globle_option_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  `inserted_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `inserted_by` varchar(255) DEFAULT NULL COMMENT 'for after INSERT trigger',
  `updated_by` varchar(255) DEFAULT NULL COMMENT 'for after UPDATE trigger',
  PRIMARY KEY (`globle_option_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `globle_option` */

insert  into `globle_option`(`globle_option_id`,`name`,`image`,`status`,`is_del`,`inserted_on`,`updated_on`,`inserted_by`,`updated_by`) values (1,'Dynamic Gym','logo.png',1,0,'0000-00-00 00:00:00','2016-05-04 08:26:12',NULL,NULL);

/*Table structure for table `modules` */

DROP TABLE IF EXISTS `modules`;

CREATE TABLE `modules` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `module_slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `module_parent_id` int(11) DEFAULT NULL,
  `have_child` tinyint(1) DEFAULT NULL,
  `sort_id` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon_class` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  `inserted_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `inserted_by` int(11) DEFAULT NULL COMMENT 'for AFTER INSERT trigger',
  `updated_by` int(11) DEFAULT NULL COMMENT 'for AFTER UPDATE trigger',
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `modules` */

insert  into `modules`(`module_id`,`module_name`,`module_slug`,`module_parent_id`,`have_child`,`sort_id`,`icon_class`,`status`,`is_del`,`inserted_on`,`updated_on`,`inserted_by`,`updated_by`) values (7,'CUSTOMER','customer',0,1,'20.00','fa-users ',1,0,'2016-03-06 12:39:21','2016-03-06 12:39:21',NULL,NULL),(8,'Registration','registration',7,0,'20.10',NULL,1,0,'2016-03-06 12:43:53','2016-03-06 12:43:53',NULL,NULL),(9,'BILLING','config',0,1,'10.00','fa-credit-card ',1,0,'2016-03-13 13:34:25','2016-03-13 13:34:25',NULL,NULL),(10,'Fee Config','fee_config',9,0,'10.10',NULL,1,0,'2016-03-13 13:33:44','2016-03-13 13:33:44',NULL,NULL),(11,'Attendence','attandence',7,0,'20.20',NULL,0,0,'2016-03-16 23:26:44','2016-03-16 23:26:44',NULL,NULL),(12,'Collections','fee_month',9,0,'10.20',NULL,1,0,'2016-03-19 12:26:22','2016-03-19 12:26:22',NULL,NULL),(13,'REPORTS','reports',0,1,'30.00','ace-icon fa fa-file-text',1,0,'2016-03-24 22:34:16','2016-03-24 22:34:16',NULL,NULL),(14,'Registration Report','registration_report',13,0,'30.10',NULL,1,0,'2016-03-24 22:46:44','2016-03-24 22:46:44',NULL,NULL),(15,'Collection Report','fee_month_report',13,0,'30.20',NULL,1,0,'2016-04-18 21:01:15','2016-04-18 21:01:15',NULL,NULL),(16,'APP','app',0,1,'05.00','fa-desktop',1,0,'2016-04-24 17:04:02','2016-04-24 17:04:02',NULL,NULL),(17,'Manage User','manage_user',16,0,'05.11',NULL,1,0,'2016-04-24 17:09:16','2016-04-24 17:09:16',NULL,NULL),(18,'Globle Option','globle_option',16,0,'05.10',NULL,1,0,'2016-04-30 23:58:15','2016-04-30 23:58:15',NULL,NULL);

/*Table structure for table `registration` */

DROP TABLE IF EXISTS `registration`;

CREATE TABLE `registration` (
  `registration_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cnic` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `grn` int(11) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `shift` tinyint(1) NOT NULL,
  `date` date DEFAULT NULL,
  `customer_status` int(11) DEFAULT NULL,
  `fee_amount` double(11,2) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  `inserted_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `inserted_by` varchar(255) DEFAULT NULL COMMENT 'for after INSERT trigger',
  `updated_by` varchar(255) DEFAULT NULL COMMENT 'for after UPDATE trigger',
  PRIMARY KEY (`registration_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `registration` */

insert  into `registration`(`registration_id`,`name`,`father_name`,`cnic`,`image`,`grn`,`mobile_no`,`email`,`shift`,`date`,`customer_status`,`fee_amount`,`status`,`is_del`,`inserted_on`,`updated_on`,`inserted_by`,`updated_by`) values (1,'jkfjsdl','kdfjsklfj','5495809','Lighthouse.jpg',3,'34850','waqar@gmail.com',0,'2016-03-24',2,1000.00,1,0,'2016-03-18 04:02:19','2016-03-23 01:08:37','Admin','Amdin'),(3,'asnari','asndask','4234','Hydrangeas.jpg',2,'33423','w@gamil.com',1,'2016-03-30',1,1000.00,1,0,'2016-03-23 12:44:11','2016-04-30 06:35:22','Admin','Admin'),(4,'SALEEM','akhter','82747730',NULL,4,'0986544','saleem@gamil.com',0,'2016-04-13',1,1000.00,1,0,'2016-04-24 01:50:52','0000-00-00 00:00:00','Admin','Admin'),(5,'Saleem','Akhter','9437428423','Tulips.jpg',5,'834234','Saleem@gmail.com',0,'2016-04-01',1,1000.00,1,0,'2016-04-24 08:54:19','0000-00-00 00:00:00','waqar',NULL);

/*Table structure for table `rights` */

DROP TABLE IF EXISTS `rights`;

CREATE TABLE `rights` (
  `rights_id` int(11) NOT NULL AUTO_INCREMENT,
  `can_view` tinyint(1) DEFAULT NULL,
  `can_add` tinyint(1) DEFAULT NULL,
  `can_update` tinyint(1) DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT NULL,
  `roles_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `inserted_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `inserted_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`rights_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `rights` */

insert  into `rights`(`rights_id`,`can_view`,`can_add`,`can_update`,`can_delete`,`roles_id`,`module_id`,`is_del`,`status`,`inserted_on`,`updated_on`,`inserted_by`,`updated_by`) values (1,1,1,1,1,1,1,0,1,'2015-10-23 09:11:10','0000-00-00 00:00:00',1,NULL),(2,1,1,1,1,1,2,0,1,'2015-10-23 09:11:10','0000-00-00 00:00:00',1,NULL),(3,1,1,1,1,1,3,0,1,'2015-10-23 09:11:10','0000-00-00 00:00:00',1,NULL),(4,1,1,1,1,1,4,0,1,'2015-10-23 09:11:11','0000-00-00 00:00:00',1,NULL),(15,0,0,0,0,2,1,0,1,'0000-00-00 00:00:00','2015-10-29 06:14:59',1,NULL),(16,1,1,1,1,2,2,0,1,'0000-00-00 00:00:00','2015-10-29 06:15:00',1,NULL),(17,1,1,1,1,2,3,0,1,'0000-00-00 00:00:00','2015-10-29 06:15:00',1,NULL),(18,0,0,0,0,2,4,0,1,'0000-00-00 00:00:00','2015-10-29 06:15:00',1,NULL),(19,1,1,1,1,2,5,0,1,'0000-00-00 00:00:00','2015-10-29 06:15:00',1,NULL),(20,1,1,1,1,2,6,0,1,'0000-00-00 00:00:00','2015-10-29 06:15:00',1,NULL);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `roles_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `inserted_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `inserted_by` int(11) DEFAULT NULL COMMENT 'for after INSERT trigger',
  `updated_by` int(11) DEFAULT NULL COMMENT 'for after UPDATE trigger',
  PRIMARY KEY (`roles_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `roles` */

insert  into `roles`(`roles_id`,`role_name`,`description`,`is_del`,`status`,`inserted_on`,`updated_on`,`inserted_by`,`updated_by`) values (1,'Admin',NULL,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `roles_id` int(11) DEFAULT NULL,
  `user_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_no` decimal(11,0) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  `inserted_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `inserted_by` int(11) DEFAULT NULL COMMENT 'for after INSERT trigger',
  `updated_by` int(11) DEFAULT NULL COMMENT 'for after UPDATE trigger',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`user_id`,`roles_id`,`user_name`,`password`,`email`,`contact_no`,`avatar`,`status`,`is_del`,`inserted_on`,`updated_on`,`inserted_by`,`updated_by`) values (1,NULL,'admin','MDE5MjAyM2E3YmJkNzMyNTA1MTZmMDY5ZGYxOGI1MDA=','admin@gmail.com','312874927','Koala.jpg',1,0,'0000-00-00 00:00:00','2016-04-30 09:14:03',NULL,NULL),(2,NULL,'waqar','OWE0NjcyZDdlZjM0ZGEwZWQ2NzhmNjlkOTJhMmRjMjA=','waqar@gmail.com','123456',NULL,1,0,'2016-04-24 08:52:57','0000-00-00 00:00:00',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
