<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m201128_101348_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'picture'=> $this->string(),
            'title'=> $this->string('255'),
            'description'=> $this->string(),
            'theme'=> $this->string(),
            'author_id'=> $this->integer()->notNull(),
            'created_at'=>$this->date(),
            'updated_at'=>$this->date(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%post}}');
    }
}
