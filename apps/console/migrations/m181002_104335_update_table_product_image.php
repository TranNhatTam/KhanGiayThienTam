<?php

use yii\db\Migration;

/**
 * Class m181002_104335_update_table_product_image
 */
class m181002_104335_update_table_product_image extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product_image}}','base_url',$this->string());
        $this->addColumn('{{%product_image}}','path',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%product_image}}','base_url');
        $this->dropColumn('{{%product_image}}','path');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181002_104335_update_table_product_image cannot be reverted.\n";

        return false;
    }
    */
}
