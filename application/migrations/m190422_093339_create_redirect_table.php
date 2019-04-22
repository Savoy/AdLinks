<?php

class m190422_093339_create_redirect_table extends CDbMigration
{
	public function safeUp()
	{
	    $tableName = 'redirect';
	    $this->createTable($tableName, [
	        'id' => 'pk',
            'link_id' => 'int(11) NOT NULL',
            'ip_long' => 'int(10) UNSIGNED NOT NULL',
            'user_agent' => 'text',
            'utm_source' => 'varchar(255) DEFAULT NULL',
            'utm_medium' => 'varchar(255) DEFAULT NULL',
            'utm_campaign' => 'varchar(255) DEFAULT NULL',
            'utm_content' => 'varchar(255) DEFAULT NULL',
            'utm_term' => 'varchar(255) DEFAULT NULL',
            'created_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
        ]);
	    $this->createIndex('link_id', $tableName, 'link_id');
	    $this->addForeignKey(
	        'redirect_ibfk_link',
            $tableName,
            'link_id',
            'link',
            'id',
            'RESTRICT',
            'CASCADE'
        );
	}

	public function safeDown()
	{
        $tableName = 'redirect';
	    $this->dropForeignKey('redirect_ibfk_link', $tableName);
	    $this->dropTable($tableName);
	}
}
