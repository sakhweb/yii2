<?php

use yii\db\Migration;

class m160527_114739_init extends Migration
{
	public function up()
	{
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
		}
		$this->createTable('{{%role}}', [
			'id' => $this->primaryKey(),
			'title' => $this->string(32),
		], $tableOptions);

		$this->createTable('{{%user}}', [
			'id' => $this->primaryKey(),
			'auth_key' => $this->string(32),
			'email_confirm_token' => $this->string(),
			'password_hash' => $this->string()->notNull(),
			'name' => $this->string()->notNull(),
			'phone' => $this->string(20),
			'email' => $this->string()->notNull(),
			'role_id' => $this->smallInteger()->notNull()->defaultValue(2),
			'status' => $this->smallInteger()->notNull()->defaultValue(0),
		], $tableOptions);

		$this->createIndex('idx-user-name', '{{%user}}', 'name');
		$this->createIndex('idx-user-email', '{{%user}}', 'email');
		$this->createIndex('idx-user-status', '{{%user}}', 'status');
		$this->createIndex('FK_user_role', '{{%user}}', 'role_id');
		$this->addForeignKey(
			'FK_user_role', '{{%user}}', 'role_id', '{{%role}}', 'id', 'SET NULL', 'CASCADE'
		);
	}


	public function down()
	{
		$this->dropTable('{{%user}}');
		$this->dropTable('{{%role}}');
		
	}

	/*
	// Use safeUp/safeDown to run migration code within a transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
?>
