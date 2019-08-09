<?php

use yii\db\Migration;

/**
 * Class m181001_082827_update_table_product
 */
class m181001_082827_update_table_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product}}','weight',$this->integer());
        $this->addColumn('{{%product}}','thumbnail_base_url',$this->string());
        $this->addColumn('{{%product}}','thumbnail_path',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%product}}','weight');
        $this->dropColumn('{{%product}}','thumbnail_base_url');
        $this->dropColumn('{{%product}}','thumbnail_path');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181001_082827_update_table_product cannot be reverted.\n";

        return false;
    }
    */
}
