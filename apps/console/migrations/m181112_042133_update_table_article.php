<?php

use yii\db\Migration;

/**
 * Class m181112_042133_update_table_article
 */
class m181112_042133_update_table_article extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%article}}', 'description', $this->string(1024));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%article}}', 'description');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181112_042133_update_table_article cannot be reverted.\n";

        return false;
    }
    */
}
