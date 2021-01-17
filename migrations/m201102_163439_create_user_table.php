<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m201102_163439_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string(25)->unique()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'nickname' => $this->string(20)->notNull(),
            'auth_token' => $this->string()->defaultValue(0),
            'activate_status' => $this->integer()->defaultValue(0)->notNull(),
            'activate_code' => $this->string(),
            'create_at' => $this->date()->notNull(),
            'update_at' => $this->date()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
