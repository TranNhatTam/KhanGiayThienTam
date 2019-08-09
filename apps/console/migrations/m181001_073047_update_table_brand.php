<?php

use yii\db\Migration;

/**
 * Class m181001_073047_update_table_brand
 */
class m181001_073047_update_table_brand extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%brand}}','thumbnail_base_url',$this->string(1024));
        $this->addColumn('{{%brand}}','thumbnail_path',$this->string(1024));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181001_073047_update_table_brand cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181001_073047_update_table_brand cannot be reverted.\n";

        return false;
    }
    */
}
