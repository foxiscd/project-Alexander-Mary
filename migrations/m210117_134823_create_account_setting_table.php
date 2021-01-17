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
            'about_me' => $this->string(150),
            'phone' => $this->integer(),
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
