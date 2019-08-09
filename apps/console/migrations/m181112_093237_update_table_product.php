<?php

use yii\db\Migration;

/**
 * Class m181112_093237_update_table_product
 */
class m181112_093237_update_table_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product}}', 'priority', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropColumn('{{%product}}', 'priority');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181112_093237_update_table_product cannot be reverted.\n";

        return false;
    }
    */
}
