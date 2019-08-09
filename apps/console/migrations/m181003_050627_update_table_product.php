<?php

use yii\db\Migration;

/**
 * Class m181003_050627_update_table_product
 */
class m181003_050627_update_table_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product}}','created_at',$this->integer());
        $this->addColumn('{{%product}}','updated_at',$this->integer());
        $this->addColumn('{{%product}}','created_by',$this->string());
        $this->addColumn('{{%product}}','updated_by',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%product}}','created_at');
        $this->dropColumn('{{%product}}','updated_at');
        $this->dropColumn('{{%product}}','created_by');
        $this->dropColumn('{{%product}}','updated_by');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181003_050627_update_table_product cannot be reverted.\n";

        return false;
    }
    */
}
