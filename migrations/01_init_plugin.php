<?php

class InitPlugin extends DBMigration {
    
    function up() {
        DBManager::get()->exec("
            CREATE TABLE IF NOT EXISTS `joyride_tours` (
                `tour_id` varchar(32) NOT NULL,
                `user_id` varchar(32) NOT NULL,
                `script` varchar(128) NOT NULL,
                `chdate` bigint(20) NOT NULL,
                `mkdate` bigint(20) NOT NULL,
                PRIMARY KEY ( `tour_id` )
            ) ENGINE=MyISAM;
        ");
    }
    
    function down() {
        DBManager::get()->exec("DROP TABLE IF EXISTS `joyride_tours` ");
    }
}