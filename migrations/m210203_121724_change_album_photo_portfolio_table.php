<?php

use yii\db\Migration;

/**
 * Class m210203_121724_change_album_photo_portfolio_table
 */
class m210203_121724_change_album_photo_portfolio_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('album_photo_portfolio', 'hidden', $this->string()->defaultValue(0));
        $this->addColumn('album_photo_portfolio', 'sort', $this->integer()->defaultValue(500));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('album_photo_portfolio', 'hidden');
        $this->dropColumn('album_photo_portfolio', 'sort');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210203_121724_change_album_photo_portfolio_table cannot be reverted.\n";

        return false;
    }
    */
}
