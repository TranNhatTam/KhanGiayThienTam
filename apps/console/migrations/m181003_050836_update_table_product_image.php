<?php

use yii\db\Migration;

/**
 * Class m181003_050836_update_table_product_image
 */
class m181003_050836_update_table_product_image extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product_image}}','created_at',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%product_image}}','created_at');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181003_050836_update_table_product_image cannot be reverted.\n";

        return false;
    }
    */
}
