<?php

use yii\db\Migration;

/**
 * Class m180928_084403_update_table_product_image
 */
class m180928_084403_update_table_product_image extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%product_image}}','image_url',$this->string());
        $this->addColumn('{{%product_image}}','image_description',$this->text());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%product_image}}','image_url');
        $this->dropColumn('{{%product_image}}','image_description');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180928_084403_update_table_product_image cannot be reverted.\n";

        return false;
    }
    */
}
