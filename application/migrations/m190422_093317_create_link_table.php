<?php

class m190422_093317_create_link_table extends CDbMigration
{
	public function up()
	{
	    $tableName = 'link';
	    $this->createTable($tableName, [
            'id' => 'pk',
            'code' => 'varchar(8) NOT NULL',
            'link' => 'text NOT NULL',
            'utm_source' => 'varchar(255) DEFAULT NULL',
            'utm_medium' => 'varchar(255) DEFAULT NULL',
            'utm_campaign' => 'varchar(255) DEFAULT NULL',
            'utm_content' => 'varchar(255) DEFAULT NULL',
            'utm_term' => 'varchar(255) DEFAULT NULL',
            'status' => 'tinyint(1) DEFAULT "1"',
            'created_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'updated_at' => 'timestamp NULL DEFAULT NULL',
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	    $this->createIndex('code', $tableName, 'code', true);
	}

	public function down()
	{
	    $this->dropTable('link');
	}
}