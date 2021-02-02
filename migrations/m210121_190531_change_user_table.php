<?php

use yii\db\Migration;

/**
 * Class m210121_190531_change_user_table
 */
class m210121_190531_change_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'training_status', $this->string()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'training_status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210121_190531_change_user_table cannot be reverted.\n";

        return false;
    }
    */
}
