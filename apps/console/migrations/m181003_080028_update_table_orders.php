<?php

use yii\db\Migration;

/**
 * Class m181003_080028_update_table_orders
 */
class m181003_080028_update_table_orders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%orders}}','ship_status',$this->integer());
        $this->addColumn('{{%orders}}','payment_status',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%orders}}','ship_status');
        $this->dropColumn('{{%orders}}','payment_status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181003_080028_update_table_orders cannot be reverted.\n";

        return false;
    }
    */
}
