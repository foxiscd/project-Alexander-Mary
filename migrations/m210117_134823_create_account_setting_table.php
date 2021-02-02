<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%account_setting}}`.
 */
class m210117_134823_create_account_setting_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%account_setting}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'avatar'=> $this->string(),
            'about_me' => $this->string(500),
            'phone' => $this->string(12),
            'address' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%account_setting}}');
    }
}
