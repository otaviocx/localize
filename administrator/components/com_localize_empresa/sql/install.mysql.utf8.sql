CREATE TABLE IF NOT EXISTS `#__localize_empresa` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
`updated` DATETIME NOT NULL ,
`nome` VARCHAR(255)  NOT NULL ,
`cnpj` VARCHAR(255)  NOT NULL ,
`logo` VARCHAR(255)  NOT NULL ,
`fundacao` DATE NOT NULL ,
`sobre` TEXT NOT NULL ,
`link` VARCHAR(255)  NOT NULL ,
`telefone1` VARCHAR(255)  NOT NULL ,
`telefone2` VARCHAR(255)  NOT NULL ,
`email` VARCHAR(255)  NOT NULL ,
`corretores` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

