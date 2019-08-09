<?php

use yii\db\Migration;

/**
 * Class m181112_042508_update_table_category
 */
class m181112_042508_update_table_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%category}}', 'is_show', $this->integer());
        $this->addColumn('{{%category}}', 'number', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%category}}', 'is_show');
        $this->dropColumn('{{%category}}', 'number');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181112_042508_update_table_category cannot be reverted.\n";

        return false;
    }
    */
}
