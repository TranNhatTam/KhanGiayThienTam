<?php

use yii\db\Migration;

/**
 * Class m181003_092107_update_table_product
 */
class m181003_092107_update_table_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product}}','code',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%product}}','code');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181003_092107_update_table_product cannot be reverted.\n";

        return false;
    }
    */
}
