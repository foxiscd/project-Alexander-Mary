<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%album_photo_portfolio}}`.
 */
class m210202_115018_create_album_photo_portfolio_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%album_photo_portfolio}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->date()->notNull(),
            'updated_at' => $this->date()->notNull(),
            'directions' => $this->string()->notNull(),
            'cover' => $this->string(),
            'title' => $this->string('50'),
            'description' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%album_photo_portfolio}}');
    }
}
