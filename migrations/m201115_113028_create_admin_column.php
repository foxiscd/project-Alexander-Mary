<?php

use yii\db\Migration;

/**
 * Class m201115_113028_create_admin_column
 */
class m201115_113028_create_admin_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'role', $this->string(64)->defaultValue('user'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user','role');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201115_113028_create_admin_column cannot be reverted.\n";

        return false;
    }
    */
}
