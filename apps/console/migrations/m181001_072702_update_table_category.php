<?php

use yii\db\Migration;

/**
 * Class m181001_072702_update_table_category
 */
class m181001_072702_update_table_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%category}}','thumbnail_base_url',$this->string(1024));
        $this->addColumn('{{%category}}','thumbnail_path',$this->string(1024));
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181001_072702_update_table_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181001_072702_update_table_category cannot be reverted.\n";

        return false;
    }
    */
}
