<?php

use yii\db\Migration;

/**
 * Class m210202_115705_change_photo_table
 */
class m210202_115705_change_photo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('photo', 'album_id', $this->string()->defaultValue(0));
        $this->dropColumn('photo', 'directions');
        $this->dropColumn('photo', 'description');
        $this->dropColumn('photo', 'title');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('photo', 'description', $this->string());
        $this->addColumn('photo', 'directions', $this->string()->notNull());
        $this->addColumn('photo', 'title', $this->string('50'));
        $this->dropColumn('photo', 'album_id');
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210202_115705_change_photo_table cannot be reverted.\n";

        return false;
    }
    */
}
