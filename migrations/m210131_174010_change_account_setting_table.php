<?php

use yii\db\Migration;

/**
 * Class m210131_174010_change_account_setting_table
 */
class m210131_174010_change_account_setting_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('account_setting', 'first_name', $this->string());
        $this->addColumn('account_setting', 'last_name', $this->string());
        $this->addColumn('account_setting', 'birthday', $this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('account_setting', 'first_name');
        $this->dropColumn('account_setting', 'last_name');
        $this->dropColumn('account_setting', 'birthday');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210131_174010_change_account_setting_table cannot be reverted.\n";

        return false;
    }
    */
}
