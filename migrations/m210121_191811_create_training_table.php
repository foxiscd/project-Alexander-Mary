<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%training}}`.
 */
class m210121_191811_create_training_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%training}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string('255')->notNull(),
            'training_code' => $this->string('255')->notNull(),
            'date_valid' => $this->date(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%training}}');
    }
}
